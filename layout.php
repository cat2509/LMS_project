<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Table Booking</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        #libraryLayout {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 15px;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .table {
            border-radius: 20px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
            height: 60px;
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
        }
        .available {
            background-color: #c8e6c9;
            color: #1b5e20;
        }
        .available:hover {
            background-color: #81c784;
        }
        .reserved {
            background-color: #ffcdd2;
            color: #b71c1c;
            cursor: not-allowed;
        }
        .empty {
            background-color: transparent;
            border-color: transparent;
            cursor: default;
            height: 60px;
        }
        .dropdown-container {
            display: flex;
            gap: 20px;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .dropdown-container label {
            font-size: 16px;
            font-weight: bold;
        }
        select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        
          /* Submit Button */
          .reserve-button a {
            
    text-decoration: none;
    color: white;
    display: block;
    width: 100%;
    height: 100%;
  
}


        #reserve-button:hover {
            
            transform: translateY(-2px);
            box-shadow: 0 7px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <header>
        <h1>Library Table Booking</h1>
    </header>
    <main>
        <h2>Real-Time Library Layout</h2>
        <div id="libraryLayout"></div>
        <h2>Seat Selection</h2>
        <div class="dropdown-container">
            <label for="studentId">Student ID:</label>
            <select id="studentId">
                <option value="">Select Student ID</option>
                <option value="S101">S101</option>
                <option value="S102">S102</option>
                <option value="S103">S103</option>
            </select>
            <label for="tableNumber">Table Number:</label>
            <select id="tableNumber">
                <option value="">Select Table Number</option>
                <script>
                    for (let i = 1; i <= 26; i++) {
                        document.write(`<option value="T${i}">T${i}</option>`);
                    }
                </script>
            </select>
            <label for="chairs">Chairs:</label>
            <select id="chairs">
                <option value="">Select Number of Chairs</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <h1>     </h1>
        <button class="reserve-button" id="reserveButton">
    <a href="reservation.php">Reserve Table</a>
</button>
        <div class="result" id="result">Please make your selections.</div>
    </main>
    <footer>
        <p>© 2025 Library Table Booking</p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const libraryLayout = document.getElementById('libraryLayout');
            const studentId = document.getElementById("studentId");
            const tableNumber = document.getElementById("tableNumber");
            const chairs = document.getElementById("chairs");
            const result = document.getElementById("result");
            const tablesData = [];
            let tableIndex = 1;
            const rowStructure = [7, 7, 5, 7];
            let totalColumns = Math.max(...rowStructure);
            for (let row = 0; row < rowStructure.length; row++) {
                for (let col = 0; col < totalColumns; col++) {
                    if (col < rowStructure[row]) {
                        tablesData.push({
                            id: tableIndex,
                            row: row + 1,
                            column: col + 1,
                            status: Math.random() > 0.3 ? 'available' : 'reserved'
                        });
                        tableIndex++;
                    } else {
                        tablesData.push(null);
                    }
                }
            }
            function createTableElement(table) {
                const tableElement = document.createElement('div');
                tableElement.classList.add('table');
                if (!table) {
                    tableElement.classList.add('empty');
                } else {
                    tableElement.textContent = `Table ${table.id}`;
                    tableElement.classList.add(table.status);
                    if (table.status === 'available') {
                        tableElement.addEventListener('click', function() {
                            alert(`Table ${table.id} selected.`);
                            tableNumber.value = `T${table.id}`;
                            updateResult();
                        });
                    } else {
                        tableElement.setAttribute('aria-disabled', 'true');
                    }
                }
                return tableElement;
            }
            function renderLayout() {
                libraryLayout.innerHTML = '';
                for (let row = 0; row < rowStructure.length; row++) {
                    for (let col = 0; col < totalColumns; col++) {
                        const table = tablesData[row * totalColumns + col];
                        libraryLayout.appendChild(createTableElement(table));
                    }
                }
            }
            function updateResult() {
                const selectedStudent = studentId.value;
                const selectedTable = tableNumber.value;
                const selectedChairs = chairs.value;
                result.textContent = selectedStudent && selectedTable && selectedChairs
                    ? `Selected: Student ID ${selectedStudent}, Table ${selectedTable}, Chairs ${selectedChairs}`
                    : "Please make your selections.";
            }
            libraryLayout.style.gridTemplateColumns = `repeat(${totalColumns}, 1fr)`;
            renderLayout();
            studentId.addEventListener("change", updateResult);
            tableNumber.addEventListener("change", updateResult);
            chairs.addEventListener("change", updateResult);
        });
    </script>
</body>
</html>
