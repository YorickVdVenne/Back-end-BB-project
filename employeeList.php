<script>
fetch('http://dummy.restapiexample.com/api/v1/employees')
    .then(res => res.json())
    .then(res => {
        console.log(res.data);
        let output = '';
        for(let i in res.data) {
            output += `<tr>
                <td>${res.data[i].employee_name}</td>
                <td>${res.data[i].employee_salary}</td>
                <td>${res.data[i].employee_age}</td>
            </tr>`;
        }
        document.querySelector('.tbody').innerHTML = output;
    }).catch(error => console.log(error));

</script>

<?php
require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EmployeeList</title>
</head>
<body>
    <div class="container">
        <p><strong>Check out the Employee's fetched from an external webservice called Dummy.restapiexample</strong></p>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered">
                    <thead>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Age</th>
                    </thead>
                    <tbody class="tbody">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


<?php 
require "footer.php";
?>