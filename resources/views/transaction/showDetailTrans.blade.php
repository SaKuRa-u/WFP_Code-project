<ul>
    @foreach ($data as $service)
        <li>
            {{ $service->service_name }}
            -
            Rp {{ number_format($service->price, 0, ',', '.') }}
        </li>
    @endforeach
</ul>

<hr>

<h4>
    Total:
    Rp {{ number_format($data->sum('price'), 0, ',', '.') }}
</h4>
