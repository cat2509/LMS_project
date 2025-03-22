<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Reservation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    
    <style>
        /* Global Styles */
        body {
            background-color: #f5f5f5;
            text-align: center;
            font-family: 'Roboto', sans-serif;
            color: #333;
            background-image: url("library-background.jpg");
            background-size: cover;
            background-position: center;
        }

        /* Reservation Form */
        #reservation-form {
            max-width: 700px;
            margin: 40px auto;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 10px;
            color: #37474f;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 14px;
            background-color: #ffffff;
            border: 1px solid #a7b6b1;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 17px;
            color: #444;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #546e7a;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        /* Submit Button */
        #reservation-form button {
            background-color: #546e7a;
            color: white;
            padding: 16px 30px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 19px;
            display: block;
            margin: 40px auto 0;
            transition: all 0.3s ease;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        #reservation-form button:hover {
            background-color: #455a64;
            transform: translateY(-2px);
            box-shadow: 0 7px 15px rgba(0, 0, 0, 0.2);
        }

        /* Confirmation Message */
        #confirmation-message {
            margin-top: 40px;
            padding: 25px;
            background-color: #eceff1;
            border: 1px solid #cfd8dc;
            color: #37474f;
            border-radius: 12px;
            font-size: 17px;
            display: none;
        }

        /* Date and Time Inputs */
        .date-time-group {
            display: flex;
            justify-content: space-between;
        }

        .date-time-group .form-group {
            width: 48%;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            #reservation-form {
                margin: 10px;
                padding: 20px;
            }

            .form-group input,
            .form-group select {
                font-size: 16px;
                padding: 14px;
            }

            #reservation-form button {
                font-size: 18px;
                padding: 14px 24px;
            }

            .date-time-group {
                flex-direction: column;
            }

            .date-time-group .form-group {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Table Reservation</h1>
    </header>

    <main>
        <section id="reservation-form">
            <h2>Enter Your Details</h2>

            <div id="confirmation-message">
                <h3>Reservation Successful!</h3>
                <p>Your reservation details:</p>
                <ul id="reservation-details">
                    <li>Table ID: <span id="confirm-table-id"></span></li>
                    <li>College ID: <span id="confirm-college-id"></span></li>
                    <li>Email: <span id="confirm-email"></span></li>
                    <li>Duration: <span id="confirm-duration"></span></li>
                    <li>Date: <span id="confirm-date"></span></li>
                    <li>Time: <span id="confirm-time"></span></li>
                </ul>
            </div>

            <form id="reservationForm">
                <div class="form-group">
                    <label>Table Number:</label>
                    <p id="tableNumberDisplay"></p>
                </div>

                <input type="hidden" id="tableId" name="tableId">

                <div class="form-group">
                    <label for="collegeId">College ID:</label>
                    <input type="text" id="collegeId" name="collegeId" required>
                </div>

                <div class="form-group">
                    <label for="email">College Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="date-time-group">
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>

                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="duration">Duration:</label>
                    <select id="duration" name="duration" required>
                        <option value="">Select Duration</option>
                        <option value="30">30 Minutes</option>
                        <option value="60">1 Hour</option>
                        <option value="90">1.5 Hours</option>
                        <option value="120">2 Hours</option>
                    </select>
                </div>

                <button type="submit">Confirm Reservation</button>
            </form>
        </section>
    </main>

    <footer>
        <p>© 2025 Library Table Booking</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function getQueryParam(name) {
                return new URLSearchParams(window.location.search).get(name);
            }

            const tableId = getQueryParam('tableId');
            document.getElementById('tableId').value = tableId;
            document.getElementById('tableNumberDisplay').textContent = tableId;

            loadLastReservation();

            document.getElementById('reservationForm').addEventListener('submit', function(event) {
                event.preventDefault();

                const reservationData = {
                    tableId: document.getElementById('tableId').value,
                    collegeId: document.getElementById('collegeId').value,
                    email: document.getElementById('email').value,
                    duration: document.getElementById('duration').value,
                    date: document.getElementById('date').value,
                    time: document.getElementById('time').value
                };

                localStorage.setItem('lastReservation', JSON.stringify(reservationData));

                for (const key in reservationData) {
                    document.getElementById('confirm-' + key).textContent = reservationData[key];
                }

                document.getElementById('confirmation-message').style.display = 'block';
            });

            function loadLastReservation() {
                const lastReservation = localStorage.getItem('lastReservation');
                if (lastReservation) {
                    Object.assign(document.getElementById('reservationForm'), JSON.parse(lastReservation));
                }
            }
        });
    </script>
</body>
</html>
