<!DOCTYPE html>
<html>
<head>
    <title>Real-time Database Updates</title>
    <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
                color: #333;
                font-weight: bold;
            }
            td {
                background-color: #fff;
                color: #555;
            }
            tr:nth-child(even) td {
                background-color: #f9f9f9;
            }
            tr:hover td {
                background-color: #e3e3e3;
            }
          </style>
</head>
<body>
    <table id="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Action</th>
                <th>Pin</th>
                <th>Value</th>
                <th>Frequency</th>
            </tr>
        </thead>
        <tbody id="data-body">
            <!-- The table body will be dynamically populated -->
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchData() {
            $.ajax({
                url: 'data.php', // Replace with the PHP file that retrieves data from the database
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Clear existing table rows
                    $('#data-body').empty();

                    // Iterate through the data and add rows to the table
                    $.each(data, function(index, item) {
                        var row = $('<tr>');
                        row.append($('<td>').text(item.id));
                        row.append($('<td>').text(item.action));
                        row.append($('<td>').text(item.pin));
                        row.append($('<td>').text(item.value));
                        row.append($('<td>').text(item.frequency));
                        $('#data-body').append(row);
                    });
                },
                complete: function() {
                    // Schedule the next fetch after a certain interval (e.g., 5 seconds)
                    setTimeout(fetchData, 500);
                }
            });
        }

        // Initial fetch
        fetchData();
    </script>
</body>
</html>
