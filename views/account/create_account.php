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

.form-row input,
.form-row select {
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

.date-row select {
    width: 30%;
    padding: 10px;
    border: 1px solid #1e3a8a;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
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
                <input type="text" placeholder="Full Name" required>
                <input type="text" placeholder="Email" required>
            </div>
            <div class="form-row">
                <input type="email" placeholder="Password" required>
                <input type="text" placeholder="Role" required>
            </div>
            <div class="form-row date-row">
                <select id="day" name="day" required>
                    <option value="" disabled selected>Day</option>
                </select>
                <select id="month" name="month" required>
                    <option value="" disabled selected>Month</option>
                </select>
                <select id="year" name="year" required>
                    <option value="" disabled selected>Year</option>
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

<script>
        // Function to populate the months
    function populateMonths() {
        const monthSelect = document.getElementById('month');
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        
        months.forEach((month, index) => {
            const option = document.createElement("option");
            option.value = String(index + 1).padStart(2, '0');
            option.textContent = month;
            monthSelect.appendChild(option);
        });
    }

    // Function to populate the years (adjust the range as needed)
    function populateYears() {
        const yearSelect = document.getElementById('year');
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 100; // 100 years ago
        const endYear = currentYear; // Current year
        
        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
    }

    // Function to update the day dropdown based on selected month and year
    function updateDays() {
        const month = document.getElementById('month').value;
        const year = document.getElementById('year').value;
        const daySelect = document.getElementById('day');
        
        // Clear existing day options
        daySelect.innerHTML = '<option value="" disabled selected>Day</option>';

        if (!month || !year) return; // Exit if month or year is not selected

        let daysInMonth;

        // Leap year check for February
        if (month === "02") {
            if ((year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0)) {
                daysInMonth = 29; // Leap year
            } else {
                daysInMonth = 28; // Non-leap year
            }
        } else if (["04", "06", "09", "11"].includes(month)) {
            daysInMonth = 30; // April, June, September, November
        } else {
            daysInMonth = 31; // January, March, May, July, August, October, December
        }

        // Populate day options
        for (let i = 1; i <= daysInMonth; i++) {
            const option = document.createElement("option");
            option.value = String(i).padStart(2, '0');
            option.textContent = i;
            daySelect.appendChild(option);
        }
    }

    // Initialize the form
    function initializeForm() {
        populateMonths();
        populateYears();

        // Automatically select the first available month & year
        document.getElementById('month').selectedIndex = 1;
        document.getElementById('year').selectedIndex = 1;

        // Call updateDays() initially to populate the day dropdown
        updateDays();
    }

    // Event listeners for dynamic updating of days based on month and year
    document.getElementById('month').addEventListener('change', updateDays);
    document.getElementById('year').addEventListener('change', updateDays);

    // Initialize form on page load
    window.onload = initializeForm;

</script>


