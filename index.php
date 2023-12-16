<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="display:flex; justify-content: space-around;">
    <div>
        <form id="test-add">
            <input type="hidden" name="action" value="add_form">
            <input type="text" name="name" placeholder="name">
            <input type="text" name="mobile" placeholder="mobile">
            <button type="submit">Go</button>
        </form>
    </div>

    <div>
        <table style="border :1px solid black">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Name</th>
                    <th>Mobile</th>
                </tr>
            </thead>
            <tbody id="table_body">

            </tbody>
        </table>
    </div>
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){

        
        tableLoad();

        $('#test-add').submit(function(e){
            e.preventDefault();
            var form = document.getElementById('test-add')
            var formData = new FormData(form);
            
            console.log('working 1');
            $.ajax({
                
                url :   'http://localhost/phpajax/libraryPHP/allcontroller.php',
                method: 'POST',
                processData: false, 
                contentType: false,
                data: formData,
                success:function(data){
                    var response = JSON.parse(data);
                    
                    Swal.fire({
                        title: "Success",
                        text: "Data Added Successfully",
                        icon: "success"
                    });

                    $("#test-add").get(0).reset(); 
                    tableLoad();
                },
                error:function(data){
                    alert('bad');
                }
            })
        });

        function tableLoad() {

            var formData = {
                action : 'get_table',
            }
            
            $.ajax({
                url :   'http://localhost/phpajax/libraryPHP/allcontroller.php',
                method: 'GET',
                data: formData,
                success:function(data){
                    var response = JSON.parse(data);
                    console.log(response.data);

                    var records = response.data;
                    var text = '';
                    if(records){
                        for(i=0; i<records.length; i++){
                            var name = records[i].name;
                            var mobile = records[i].mobile;

                            text += '<tr>';
                            text += '<td>' + i + '</td>';
                            text += '<td>' + name + '</td>';
                            text += '<td>' + mobile + '</td>';
                            text += '</tr>';
                        }
                    }
                    else{
                        text += '<tr><td colspan="3">No Records Found</td></tr>';
                    }
                    console.log(text);
                    $('#table_body').html(text);
                    
                },
                error:function(data){
                    alert('bad');
                }
            })
        }

    });
</script>
</html>