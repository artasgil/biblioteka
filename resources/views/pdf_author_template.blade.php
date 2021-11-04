<style>
    .styled-table {
        border-collapse: collapse;
        margin: 5px 0;
        font-size: 0.9em;
        font-family: dejavu serif;
        font-size: 13px;
        width: 100%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;

    }

    .styled-table th,
    .styled-table td {
        padding: 10px 10px;
        border: 2px solid #000000;
        text-align: left;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
</style>

    <table class="styled-table">
        <thead>
            <tr>
                <th> ID </th>
                <th> Name </th>
                <th> Surname</th>
                <th> How many books have author </th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$author->id}}</td>
                <td>{{$author->name}}</td>
                <td>{{$author->surname}}</td>
                <td>{{ $author->authorAll->count() }} </td>
            </tr>
        </tbody>
    </table>
