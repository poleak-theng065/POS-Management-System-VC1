<style>
    /* styles.css */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #e6f0fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 95%;
    height: 85%;
    margin: auto;
    margin-bottom:70px;
    padding-top: 100px;
    
}

.form-container h2 {
    text-align: center;
    color: #1e3a8a;
    margin-bottom: 20px;
    border-bottom: 1px solid #1e3a8a;
    padding-bottom: 20px;
    position: relative;
    bottom: 50px;
}

.form-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.form-row input {
    width: 48%;
    padding: 10px;
    border: 1px solid #1e3a8a;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
}

.form-row input::placeholder {
    color: #aaa;
}

.date-row {
    display: flex;
    justify-content: space-between;
}


button {
    width: 100%;
    padding: 12px;
    background-color:rgba(46, 31, 251, 0.85);
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 80px;
}

button:hover {
    background-color:rgb(20, 6, 220);
}

.checkbox-row {
    display: flex;
    align-items: center;
    margin-top: 15px;
    font-size: 12px;
    color: #1e3a8a;
}

.checkbox-row input {
    margin-right: 5px;
}

.checkbox-row label {
    color: #1e3a8a;
}

.form-image{
    height: 80px;
    width: 100%;
    margin-top:40px;
    /* display: flex; */
}
.image{
    border: solid 1px;
    height: 100px;
    border-radius: 4px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

select {
    width: 100%;
    padding: 10px;
    border: 1px solid #1e3a8a;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
    background-color: #fff;
    cursor: pointer;
    height: 44px;
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Create New Account</h2>
        <form>
            <div class="form-row">
                <input type="text" placeholder="First Name" required>
                <input type="text" placeholder="Last Name" required>
            </div>
            <div class="form-row">
                <input type="email" placeholder="Email" required>
                <input type="text" placeholder="Password" required>
            </div>
            <div class="form-row">
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="stock manager">Stock Manager</option>
                    <option value="cashier">Cashier</option>
                </select>
            </div>

            <div class="form-image">
                <label for="profile-image">Upload Profile Image:</label>
                <div class="image"><input type="file" id="profile-image" name="profile-image" accept="image/*" required></div>
            </div>
            <button type="submit">SUBMIT</button>
        </form>
    </div>
</body>
</html>

