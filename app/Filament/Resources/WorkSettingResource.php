<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkSettingResource\Pages;
use App\Models\WorkSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WorkSettingResource extends Resource
{
    protected static ?string $model = WorkSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Jam Kerja';
    protected static ?string $modelLabel = 'Jam Kerja';
    protected static ?string $pluralModelLabel = 'Pengaturan Jam Kerja';
    protected static ?string $navigationGroup = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pengaturan Jam Kerja')
                    ->description('Atur jam masuk & jam pulang. Telat dihitung tepat dari jam masuk (tanpa toleransi).')
                    ->schema([
                        Forms\Components\TextInput::make('day_name')
                            ->label('Hari')
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Hari Kerja Aktif')
                            ->helperText('Matikan jika hari ini libur (misal Minggu).')
                            ->default(true),

                        Forms\Components\TimePicker::make('jam_masuk')
                            ->label('Jam Masuk')
                            ->seconds(false)
                            ->native(false)
                            ->displayFormat('H:i')
                            ->format('H:i')
                            ->required(fn (Forms\Get $get) => $get('is_active'))
                            ->helperText('Absen setelah jam ini langsung dihitung telat.'),

                        Forms\Components\TimePicker::make('jam_pulang')
                            ->label('Jam Pulang')
                            ->seconds(false)
                            ->native(false)
                            ->displayFormat('H:i')
                            ->format('H:i')
                            ->required(fn (Forms\Get $get) => $get('is_active'))
                            ->after('jam_masuk'),

                        Forms\Components\TextInput::make('toleransi_telat')
                            ->label('Toleransi Keterlambatan (menit)')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(120)
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Kebijakan PT. Pakita Jaya: tidak ada toleransi (0 menit).'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('day_name')
                    ->label('Hari')
                    ->weight('bold')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jam_masuk')
                    ->label('Jam Masuk')
                    ->badge()
                    ->color('success')
                    ->placeholder('Libur')
                    ->formatStateUsing(fn ($state) => $state ? substr($state, 0, 5) : null),

                Tables\Columns\TextColumn::make('jam_pulang')
                    ->label('Jam Pulang')
                    ->badge()
                    ->color('danger')
                    ->placeholder('Libur')
                    ->formatStateUsing(fn ($state) => $state ? substr($state, 0, 5) : null),

                Tables\Columns\TextColumn::make('toleransi_telat')
                    ->label('Toleransi')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn ($state) => $state == 0 ? 'Tanpa toleransi' : "{$state} menit"),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square'),
            ])
            ->bulkActions([])
            ->paginated(false)
            ->emptyStateHeading('Belum ada pengaturan jam kerja');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkSettings::route('/'),
            'edit'  => Pages\EditWorkSetting::route('/{record}/edit'),
        ];
    }
}