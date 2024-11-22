<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>action</th>
                <th>name</th>
                <th>quantity</th>
                <th>room type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roms as $rom)
                <livewire:RomTr :rom="$rom" wire:key="{{$rom['id']}}" />
            @endforeach
        <tbody/>

    </table>
</div>


