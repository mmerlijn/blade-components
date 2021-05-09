@props(['name','options'=>[],'value'=>''])
<select id="{{$name}}" name="{{$name}}" autocomplete="off" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    @foreach($options as $k=>$option)
        <option value="{{$k}}" @if($value==$k) selected @endif>{{$option}}</option>
    @endforeach
</select>