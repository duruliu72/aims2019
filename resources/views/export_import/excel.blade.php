<table>
            <thead>
              <tr>
                <th>Applicantid</th>
                <th>pin_code</th>
                <th>firstName</th>
                <th>middleName</th>
                <th>LastName</th>
                <th>phone</th>
              </tr>
            </thead>
            <tbody>
              <?php $id=0; ?>
              @foreach($applicant_data as $x)
              <tr>
                <td>{{$x->applicantid}}</td>
                <td>{{$x->pin_code}}</td>
                <td>{{$x->firstName}}</td>
                <td>{{$x->middleName}}</td>
                <td>{{$x->lastName}}</td>
                <td>{{$x->phone}}</td>
              </tr>
              @endforeach
            </tbody>
</table>