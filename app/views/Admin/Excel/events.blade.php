<table>
    <tbody>
    <tr>
        <td>Sifra</td>
        <td>Naziv</td>
        <td>Opis</td>
        <td>Organizator</td>
        <td>Pocetak</td>
        <td>Kraj</td>
        <td>Procjenjeni broj volontera</td>
        <td>Radni sati</td>
        <td>Ukupno sati</td>
        <td>Adresa</td>
        <td>Grad</td>
        <td>Županija</td>
        <td>Regija</td>
        <td>Kontakt osoba</td>
        <td>Telefon</td>
        <td>Email</td>
        <td>Dodatna napomena</td>
        <td>Volonterska manifestacija</td>
        <td>Zavrsni broj volontera</td>
        <td>Zavrsni broj sati</td>
        <td>Zavrsni izvjesta</td>
        <td>Kreirano</td>
        <td>Azurirano</td>
    </tr>
    @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->name}}</td>
            <td>{{$event->description}}</td>
            <td>{{$event->getHost()->name}}</td>
            <td>{{$event->start}}</td>
            <td>{{$event->end}}</td>
            <td>{{$event->estimated_volunteers_no}}</td>
            <td>{{$event->working_hours}}</td>
            <td>{{$event->total_hours}}</td>
            <td>{{$event->address}}</td>
            <td>{{$event->getCity()->name}}</td>
            <td>{{$event->getCounty()->name}}</td>
            <td>{{$event->getRegion()->name}}</td>
            <td>{{$event->contact_person}}</td>
            <td>{{$event->phone}}</td>
            <td>{{$event->email}}</td>
            <td>{{$event->additional_note}}</td>
            <td>{{$event->getAction()->name}}</td>
            <td>{{$event->final_estimated_volunteers_no}}</td>
            <td>{{$event->final_total_hours}}</td>
            <td>{{$event->final_report}}</td>
            <td>{{$event->created_at}}</td>
            <td>{{$event->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>