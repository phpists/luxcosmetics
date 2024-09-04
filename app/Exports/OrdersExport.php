<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{

    public function __construct(public readonly ?Collection $collection = null)
    {
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return $this->collection ?? Order::all();
    }

    public function headings(): array
    {
        return [
            'Дата',
            'Номер',
            'Имя',
            'Email',
            'Телефон',
            'Город',
            'Самовывоз/Доставка',
            'Адресс',
            'Сумма',
        ];
    }

    public function map($row): array
    {
        return [
            $row->pretty_created_at,
            $row->num,
            $row->full_name,
            $row->email,
            $row->phone,
            $row->city,
            $row->delivery_type == 'courier'
                ? 'Доставка'
                : ($row->delivery_type == 'pickup'
                    ? 'Самовывоз'
                    : ''),
            $row->address,
            $row->total_sum,
        ];
    }

}
