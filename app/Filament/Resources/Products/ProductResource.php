<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages;
use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Models\Category;
use App\Models\Product;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Produk';
    protected static string|\UnitEnum|null $navigationGroup = 'Katalog';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Produk')->schema([
                Select::make('category_id')
                    ->label('Kategori')
                    ->options(Category::where('is_active', true)->pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                TextInput::make('name')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, \Filament\Schemas\Components\Utilities\Set $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Select::make('unit')
                    ->label('Satuan')
                    ->options(['ikat' => 'Ikat', 'kg' => 'Kg', 'pcs' => 'Pcs', 'pack' => 'Pack', 'gram' => 'Gram'])
                    ->required()
                    ->default('ikat'),

                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
            ])->columns(2),

            Section::make('Harga & Stok')->schema([
                TextInput::make('price')
                    ->label('Harga Normal (Rp)')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(0),

                TextInput::make('discount_price')
                    ->label('Harga Diskon (Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->nullable()
                    ->hint('Kosongkan jika tidak ada diskon'),

                TextInput::make('stock')
                    ->label('Stok')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),

                TextInput::make('weight_grams')
                    ->label('Berat (gram)')
                    ->required()
                    ->numeric()
                    ->suffix('gr')
                    ->default(100),
            ])->columns(2),

            Section::make('Gambar & Status')->schema([
                FileUpload::make('image')
                    ->label('Foto Produk')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('products')
                    ->imageEditor()
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Produk Aktif')
                    ->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Foto')->square(),
                TextColumn::make('name')->label('Nama Produk')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Kategori')->badge()->color('info'),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('discount_price')
                    ->label('Harga Diskon')
                    ->money('IDR', locale: 'id')
                    ->placeholder('—'),
                TextColumn::make('stock')
                    ->label('Stok')
                    ->badge()
                    ->color(fn ($record) => $record->stock < 5 ? 'danger' : 'success'),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->options(Category::pluck('name', 'id')),
                TernaryFilter::make('is_active')->label('Status'),
                Filter::make('low_stock')
                    ->label('Stok Menipis (< 5)')
                    ->query(fn (Builder $query) => $query->where('stock', '<', 5)),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
