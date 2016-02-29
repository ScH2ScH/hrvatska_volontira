<table>
    <tbody>
    <tr>
        <td>Sifra</td>
        <td>Korisnik</td>
        <td>Naziv</td>
        <td>Adresa</td>
        <td>Kontakt osoba</td>
        <td>Telefon</td>
        <td>Website</td>
        <td>Email</td>
        <td>Vrsta organizacije</td>
        <td>Dodatna napomena</td>
        <td>Kreirano</td>
        <td>Azurirano</td>

    </tr>
    @foreach($hosts as $host)
        <tr>
            <td>{{$host->id}}</td>
            <td>{{$host->getUser()->username}}</td>
            <td>{{$host->name}}</td>
            <td>{{$host->address}}</td>
            <td>{{$host->contact_person}}</td>
            <td>{{$host->phone}}</td>
            <td>{{$host->web}}</td>
            <td>{{$host->host_email}}</td>
            <td>{{$host->getType()->name}}</td>
            <td>{{$host->additional_note}}</td>
            <td>{{$host->created_at}}</td>
            <td>{{$host->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>