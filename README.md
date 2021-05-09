# Installation

composer require mmerlijn/blade-components

## Publishing config file
TODO php artisan vendor:publish -tag=blade-components-config

## Table example
```html
        <x-bc-table>
            <x-slot name="header">
                @foreach(['name','age','country'] as $item)
                    <x-bc-th>{{$item}}</x-bc-th>
                @endforeach
            </x-slot>
            @foreach([['Bob','20','US'],['Elis',23,'NL']] as $k=>$row)
                <tr {{$k%2?'class=bg-gray-50':''}}>
                    @foreach($row as $cell)
                        <x-bc-td>{{$cell}}</x-bc-td>
                    @endforeach
                </tr>
            @endforeach

        </x-bc-table>
```