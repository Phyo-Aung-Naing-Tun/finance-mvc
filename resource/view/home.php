<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income & Expense Tracker</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 20px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 10px;
        }

        .balance {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .summary div {
            padding: 10px;
            border-radius: 5px;
            width: 45%;
        }

        .income {
            background-color: #d4edda;
            color: #155724;
        }

        .expense {
            background-color: #f8d7da;
            color: #721c24;
        }

        .transaction-list {
            list-style: none;
            margin-bottom: 20px;
            padding: 0;
        }

        .transaction-list li {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            margin: 5px 0;
            background: #eee;
            border-radius: 5px;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #218838;
        }

        .remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Income & Expense Tracker</h2>

        <!-- Balance Section -->
        <div class="balance">
            <h3>Your Balance</h3>
            <p id="balance">$0.00</p>
        </div>

        <!-- Income & Expense Section -->
        <div class="summary">
            <div class="income">
                <h4>Income</h4>
                <p id="income">$0.00</p>
            </div>
            <div class="expense">
                <h4>Expense</h4>
                <p id="expense">$0.00</p>
            </div>
        </div>

        <!-- Transaction List -->
        <h3>Transactions</h3>
        <ul id="transaction-list" class="transaction-list"></ul>

        <!-- Add Transaction Form -->
        <h3>Add Transaction</h3>
        <form id="transaction-form">
            <input type="text" id="description" placeholder="Enter description" required>
            <input type="number" id="amount" step="0.01" placeholder="Enter amount" required>
            <button type="submit">Add Transaction</button>
        </form>

        <a href="/login">login</a>
    </div>

    <script>
        const balanceEl = document.getElementById("balance");
        const incomeEl = document.getElementById("income");
        const expenseEl = document.getElementById("expense");
        const transactionList = document.getElementById("transaction-list");
        const transactionForm = document.getElementById("transaction-form");
        const descriptionInput = document.getElementById("description");
        const amountInput = document.getElementById("amount");

        let transactions = JSON.parse(localStorage.getItem("transactions")) || [];

        function updateUI() {
            let balance = 0,
                income = 0,
                expense = 0;
            transactionList.innerHTML = "";

            transactions.forEach((transaction, index) => {
                balance += transaction.amount;
                transaction.amount > 0 ? income += transaction.amount : expense += Math.abs(transaction.amount);

                const li = document.createElement("li");
                li.innerHTML = `
                    ${transaction.description} 
                    <span>${transaction.amount > 0 ? '+' : '-'}$${Math.abs(transaction.amount).toFixed(2)}</span>
                    <button class="remove-btn" onclick="removeTransaction(${index})">x</button>
                `;
                transactionList.appendChild(li);
            });

            balanceEl.textContent = `$${balance.toFixed(2)}`;
            incomeEl.textContent = `$${income.toFixed(2)}`;
            expenseEl.textContent = `$${expense.toFixed(2)}`;
            localStorage.setItem("transactions", JSON.stringify(transactions));
        }

        function removeTransaction(index) {
            transactions.splice(index, 1);
            updateUI();
        }

        transactionForm.addEventListener("submit", function(event) {
            event.preventDefault();
            const description = descriptionInput.value.trim();
            const amount = parseFloat(amountInput.value);
            if (!description || isNaN(amount)) return;

            transactions.push({
                description,
                amount
            });
            descriptionInput.value = "";
            amountInput.value = "";
            updateUI();
        });

        updateUI();
    </script>

</body>

</html>