<?php
    include $_SERVER['DOCUMENT_ROOT'].'/header.php';
    //include 'includes/signup.inc.php';
    
?>

<style>
    input
    {
        color: black;
    }
</style>

<center>
    <br/>
    <form method = 'POST' action = '../includes/signup.inc.php'>
        <table width='500' border'3' align='center'>
            <tr>
                <th>Registration</th>
            </tr>
            <tr>
                <td>First name: </td>
                <td><input class='inputtext' type='text' name='first'></td>
            </tr>
            <tr>
                <td>Last name: </td>
                <td><input class='inputtext' type='text' name='last'></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><input class='inputtext' type='text' name ='email'></td>
            </tr>
            <tr>
                <td>Username: </td>
                <td><input class='inputtext' type ='text' name='uid'></td>
            </tr>
            <tr>
                <td>Password:</td> 
                <td><input class='inputtext' type='password' name ='pwd'></td>
            </tr>
            <tr>
                <td>Confirm Password:</td> 
                <td><input class='inputtext' type='password' name ='confirm_pwd'></td>
            </tr>
            <tr>
                <td align='center' colspan='6'>
                    <input type='submit' name ='submit' value='Submit'>
                </td>
            </tr>
        </table>
    </form>
            
    <br/>
</center>

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>