<div>
    <table>
        <thead>
            <th>Payment Request Id</th>
            <th>Customer name</th>
            <th>Amount</th>
            <th>Status </th>
            <th>Phone number</th>
        </thead>
        <tbody>
            @if($result['success'])
            <tr>
                <td>
                    {{result['payment_request']['id']}}
                </td>
                <td>
                    {{result['payment_request']['name']}}
                </td>
                <td>
                    {{result['payment_request']['amount']}}
                </td>
                <td>
                    {{result['payment_request']['status']}}
                </td>
                <td>
                    {{result['payment_request']['phone']}}
                </td>
            </tr>
        </tbody>
    </table>
</div>
