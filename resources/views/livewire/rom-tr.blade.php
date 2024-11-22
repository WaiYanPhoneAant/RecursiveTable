

<tbody>
    <tr>
        <td style="width: 3%;"><button wire:click="fetchDetail({{$rom['id']}})" class="btn btn-sm btn-primary"> &plus; </button></td>
        <td style="width: 25%;">{{$rom?->product?->name}}</td>
        <td style="width: 25%;">{{$rom->quantity}}</td>
        <td style="width: 25%;">{{isset($romDetails[$rom['id']]) ? $romDetails[$rom['id']][0]['product_variation']['product']['name'] : 'hello'}}</td>
    </tr>

    @if(isset($romDetails[$rom['id']]))
    <tr>
        <td colspan="4">
            <table class="table table-bordered">
                <tbody>
                    @foreach ($romDetails[$rom['id']] as $romDetail)
                        @php
                            $productId=$romDetail['product_variation']['product']['id'];
                            $checkIsRomProduct=App\Models\ReceipeOfMaterial::where('product_id',$productId)->exists();
                        @endphp
                        @if(!$checkIsRomProduct)
                            <tr>
                                <td style="width: 3%;"></td>
                                <td style="width: 25%;">{{$romDetail['product_variation']['product']['name']}}</td>
                                <td style="width: 25%;">{{$romDetail['quantity']}}</td>
                                <td style="width: 25%;"></td>
                            </tr>
                        @else
                        <tr>
                            @php
                                $productId=$romDetail['product_variation']['product']['id'];
                                $rom=App\Models\ReceipeOfMaterial::where('product_id',$productId)->first();
                            @endphp
                            <livewire:RomTr :rom="$rom" wire:key="{{$rom['id']}}" />
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    @endif
</tbody>


{{-- <tr>
    <td>
        <button wire:click="fetchDetail({{$rom['id']}})" class="btn btn-sm btn-primary"> &plus; </button>
    </td>
    <td>{{$rom?->product?->name}}</td>
    <td>{{$rom->quantity}}</td>
    <td>
        <table class="table mb-0">
            <tbody>
                <td>hello</td>
                <td>hello</td>
            </tbody>
        </table>
    </td>
    <td>
        @if(isset($romDetails[$rom['id']]))
        @foreach ($romDetails[$rom['id']] as $romDetail)
                @php
                    $productId=$romDetail['product_variation']['product']['id'];
                    $checkIsRomProduct=App\Models\ReceipeOfMaterial::where('product_id',$productId)->exists();
                @endphp
            <tr>
                <td> </td>
                <td>{{$romDetail['product_variation']['product']['name']}}</td>
                <td>{{$romDetail['quantity']}}</td>
                <td>{{$romDetail['product_variation']['product']['id']}} || {{$checkIsRomProduct}}</td>
            </tr>
        @endforeach
@endif
</td>
</tr> --}}
