<table>
    <tbody>
    <tr>
        <td>Šifra</td>
        <td>Korisničko ime</td>
        <td>Email</td>
        <td>Kod potvrde</td>
        <td>Potvrđen</td>
        <td>Kreirano</td>
        <td>Ažurirano</td>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->confirmation_code}}</td>
            <td>{{$user->confirmed}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>