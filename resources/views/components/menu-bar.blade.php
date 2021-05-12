@props(['logo'=>'','right'=>''])
<nav>
    <div class="mx-auto">
        <div class="flex items-center justify-between h-12">
            <div class="flex items-center">
                @if($logo)
                    <div class="flex-shrink-0">
                        {{$logo}}
                    </div>
                @endif
                <div class="block">
                    <div class="ml-4 flex items-baseline space-x-2">
                        {{$slot}}
                    </div>
                </div>
            </div>
            @if($right)
                <div class="block">
                    <div class="ml-4 flex items-center md:ml-6">
                        {{$right}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>