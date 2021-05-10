# Installation

```shell
composer require mmerlijn/blade-components
```
To publish the config file and add js components (required for some components) config will always be overwritten
```shell
php artisan blade-components:install

# --renew option for overwriting existing files
php artisan blade-components:install --renew

#run after
npm install
npm run dev
#or
npm run prod
```

## Customisation

### config file
```shell
php artisan vendor:publish -tag=blade-components-config
```

### components views
```shell
php artisan vendor:publish -tag=blade-components-views
```


## Tailwind 2
All components use tailwind 2

## AplineJs
For some components alpineJs is needed, the install option will automatically install this node package
###### Required for:
- flash

### Theme option
Theme attribute is allowed in almost every component. The theme values could be customised in the config file.

## Example Components
### flash
#### Use
In every layout file place at the bottom of the body-tag (install wil take care off)
```html
<x-bc-flash/>
```

Now the flash messages could be called by 
```php
session()->flash('success','The messages to display');
session()->flash('danger','The messages to display');
session()->flash('waring','The messages to display');
session()->flash('notice','The messages to display');
```


### panel
#### Use
```html
        <x-bc-panel title="Hello world" theme="indigo">
            This is the content of the panel component
        </x-bc-panel>
```
#### Result
```html
<div class="shadow-lg rounded-lg overflow-auto">
    <div class="bg-indigo-100">
        <h1 class="text-xl font-bold py-2 px-4 text-indigo-800">Hello world</h1>
    </div>
    <div class="p-4">
        This is the content of the panel component
    </div>
</div>
```

### table
#### Use
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
#### Generate
```html
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-green-800">name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-green-800">age</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-green-800">country</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr >
                             <td class="px-6 py-4 whitespace-nowrap text-gray-800">Bob</td>
                             <td class="px-6 py-4 whitespace-nowrap text-gray-800">20</td>
                             <td class="px-6 py-4 whitespace-nowrap text-gray-800">US</td>
                        </tr>
                         <tr class=bg-green-50>
                             <td class="px-6 py-4 whitespace-nowrap text-gray-800">Elis</td>
                             <td class="px-6 py-4 whitespace-nowrap text-gray-800">23</td>
                             <td class="px-6 py-4 whitespace-nowrap text-gray-800">NL</td>
                         </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
```

### Checkbox
#### Use
```html
<x-bc-checkbox label="Solved" name="solution"/>
```
#### Result
```html
<div class="flex items-center">
    <input name="solution" id="solution"
           type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    <label class="ml-3 block text-sm font-medium text-gray-700" for="solution">Solved</label>
</div>
```
### Radio
#### Use
```html
<x-bc-radio name="sex" :options="['m'=>'Male','f'=>'Female']"/>
```
#### Generate
```html
<fieldset>
    <div class="flex items-center">
         <input id="m" name="sex" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
         <label for="m" class="ml-3 block text-sm font-medium text-gray-700">
         Male
         </label>
    </div>
    <div class="flex items-center">
         <input id="f" name="sex" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
         <label for="f" class="ml-3 block text-sm font-medium text-gray-700">
         Female
         </label>
    </div>
</fieldset>
```