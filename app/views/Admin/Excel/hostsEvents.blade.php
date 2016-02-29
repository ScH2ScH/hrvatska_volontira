<table>
    <tbody>
    <tr>
        <td>Sifra organizatora</td>
        <td>Naziv organizatora</td>
        <td>Adresa organizatora</td>
        <td>Kontakt osoba organizacije</td>
        <td>Tip organizacije</td>
        <td>Sifra aktivnosti</td>
        <td>Naziv aktivnosti</td>
        <td>Opis aktivnosti</td>
        <td>Pocetak aktivnosti</td>
        <td>Kraj aktivnosti</td>
        <td>Procjenjeni broj volontera</td>
        <td>Radni sati</td>
        <td>Ukupno sati</td>
        <td>Adresa aktivnosti</td>
        <td>Grad aktivnosti</td>
        <td>Županija aktivnosti</td>
        <td>Regija aktivnosti</td>
        <td>Kontakt osoba aktivnosti</td>
        <td>Telefon aktivnosti</td>
        <td>Email aktivnosti</td>
        <td>Dodatna napomena</td>
        <td>Volonterska manifestacija</td>
        <td>Zavrsni broj volontera aktivnosti</td>
        <td>Zavrsni broj sati aktivnosti</td>
        <td>Zavrsni izvjesta aktivnosti</td>
        <td>Aktivnost Kreirana</td>
        <td>Aktivnost Azurirana</td>
    </tr>
    @foreach($events as $event)
        <tr>
            <td>{{$event->getHost()->id}}</td>
            <td>{{$event->getHost()->name}}</td>
            <td>{{$event->getHost()->address}}</td>
            <td>{{$event->getHost()->contact_person}}</td>
            <td>{{$event->getHost()->getType()->name}}</td>
            <td>{{$event->id}}</td>
            <td>{{$event->name}}</td>
            <td>{{$event->description}}</td>
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