
<!--  -->
<table>
    <thead>
    <tr>
        <th>
            Guest Family Details ---- Total Guests :  {{count($guests)+count($famTotal)}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($guests as $single)
    <tr>
        <td style="font-size: 12px; font-weight:bold;text-align:center">
            {{$single->name}} ---- {{$single->email}} ---- {{$single->mobile}}
        </td>
    </tr>
    <tr>
        <th style="font-weight:bold; width:20px; text-align:center;">Name</th>
        <th style="font-weight:bold; width:20px; text-align:center;">Age</th>
        <th style="font-weight:bold; width:20px; text-align:center;">Gender</th>
        <th style="font-weight:bold; width:20px; text-align:center;">Relation</th>
        <th style="font-weight:bold; width:20px; text-align:center;">Mobile</th>
    </tr>
        @foreach($single->family as $guest)
            <tr>
                <td>{{ $guest->familyname }}</td>
                <td style="text-align: left;">{{ $guest->familyage }}</td>
                <td>{{ $guest->familygender }}</td>
                <td>{{ $guest->familyrelation }}</td>
                <td style="text-align: left;">{{ $guest->familymobile }}</td>
                <td style="text-align: left;">{{ $guest->familyshare }}</td>
            </tr>
        @endforeach
    <tr></tr>
    @endforeach
    </tbody>
</table>