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
- dropdown

### Color option
Color attribute is allowed in almost every component. All tailwind primary colors are available.
<span style="color:gray">gray</span>, 
<span style="color:red">red</span>, 
<span style="color:yellow">yellow</span>, 
<span style="color:green">green</span>, 
<span style="color:blue">blue</span>, 
<span style="color:indigo">indigo</span>, 
<span style="color:purple">purple</span>, 
<span style="color:pink">pink</span>

## Example Components
### flash
#### Use
Flash messages could be called by
```php
session()->flash('success','The messages to display');
session()->flash('danger','The messages to display');
session()->flash('waring','The messages to display');
session()->flash('notice','The messages to display');
```

#### Install
In every layout file place at the bottom of the body-tag (install wil take care off)
```html
<x-bc-flash/>
```
add blade-components/flash.js to app.js (install wil take care off)


### Modal
#### Use
```html
<a href="#modal-modal1">Show modal</a>

<x-bc-modal name="modal1">Modal content</x-bc-modal>
```
#### Install
In every layout file place in the header @stack('styles') and at the bottom of the body-tag @stack('scripts') (install wil take care off)
```html
...
@stack('styles')
</head>
...
@stack('scripts')
</body>
```
### badge
#### use
````html
<x-bc-badge color="blue">100</x-bc-badge>
````

### button
####use
```html
<x-bc-button color="blue">Klik me!</x-bc-button>
```
### panel
#### Use
```html
        <x-bc-panel title="Hello world" color="indigo">
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

### alert
Use
```html
<x-bc-alert-danger>Don't do that!</x-bc-alert-danger>
<x-bc-alert-notice>Happy Birthday!</x-bc-alert-notice>
<x-bc-alert-success>Thanks for submitting</x-bc-alert-success>
<x-bc-alert-warning>Are you sure?</x-bc-alert-warning>
```

### table
#### Use
table accepts color attribute
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
checkbox accepts color attribute
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
radio accepts color attribute
```html
<x-bc-radio name="sex" :options="['m'=>'Male','f'=>'Female']"/>
```
#### Result
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

### Menu
#### Use
```html
    <x-bc-menu title="Profile">
        <x-bc-menu-group>
            <x-bc-menu-item href="#"><x-heroicon-o-user-circle class="inline-block w-5 h-5 text-gray-500 mr-4"/>Profile</x-bc-menu-item>
            <x-bc-menu-item href="#"><x-heroicon-o-adjustments class="inline-block w-5 h-5 text-gray-500 mr-4"/>Settings</x-bc-menu-item>
            <x-bc-menu-item post="true" action="#"><x-heroicon-o-logout class="inline-block w-5 h-5 text-gray-500 mr-4"/>Logout</x-bc-menu-item>
        </x-bc-menu-group>
        <x-bc-menu-group>
            <x-bc-menu-item href="#">other</x-bc-menu-item>
        </x-bc-menu-group>
    </x-bc-menu>
```

### Tag-input
#### Use
params:
 - name
 - options 
    - array contains objects
   ```json
      [{k:100,l:'nl',d:'Netherlands'},{k:101,l:'du',d:'Germany'}]
      #or without key
      [{l:'nl',d:'Netherlands'},{l:'du',d:'Germany'}]
      ```
    - k=key, l=label, d=full display option
    - the 'k' is optional, if not present 'l' will be used
 - value (optional) 
   - comma separated label (l)    TODO: comma seperated key (k) if not presented label (l) 
 - color (optional)
   - label color
 - placeholder (optional)
   - default: Select...
 - key (optional)
   - property label for key default k
 - label (optional)
   - property label for label default l
 - display (optional)
   - property label for display default d
   - display value will be searched 


```html
<x-bc-tag-input color="yellow" name="countries" options="[{l:'nl',d:'Netherlands'},{l:'du',d:'Germany'},{l:'b',d:'Belgium'}]" value="nl,b"></x-bc-tag-input>

<x-bc-tag-input color="yellow" name="countries" :options="json_encode([['l'=>'nl','d'=>'Netherlands'],['l'=>'du','d'=>'Germany']])"></x-bc-tag-input>

<!-- TODO -->
<x-bc-tag-input color="yellow" name="landen" options="[{k:100,l:'nl',d:'Netherlands'},{k:101,l:'du',d:'Germany'},{k:102,l:'b',d:'Belgium'}]" value="nl"></x-bc-tag-input>
```
### Autocomplete (select box)
#### Use
params:
 - name
 - options (array)
      ```json
      [{k:'nl',d:'Netherlands'},{k:'du',d:'Germany'}]
      ```
   - k=key, d=full display option
   - the 'k' is optional, if not present 'l' will be used
 - value (optional)
 - placeholder (optional)
- key (optional)
   - property label for key default k
- display (optional)
   - property label for display default d
   - display value will be searched
```html
<x-bc-autocomplete name="landen" options="[{k:'nl',d:'Nederland'},{k:'du',d:'Duitsland'},{k:'b',d:'Belgie'}]" value="nl" />
```