document.addEventListener('DOMContentLoaded', function () {
    const transSystemSelect = document.getElementById('currencyType');
    const nationalCurrencySelection = document.getElementById('currencyNational');
    const foreignCurrencySection = document.querySelector('.foreign_currency_selection');
    function toggleSections() {
        if (transSystemSelect.value === 'national') {
            nationalCurrencySelection.style.display = 'block';
            foreignCurrencySection.style.display = 'none';
        } else if (transSystemSelect.value === 'foreign') {
            nationalCurrencySelection.style.display = 'none';
            foreignCurrencySection.style.display = 'block';
        } 
    }
    toggleSections();
    transSystemSelect.addEventListener('change', toggleSections);
});


document.addEventListener('DOMContentLoaded', function () {
    const employeeSelect = document.getElementById('single-select');
    const percentBasicInput = document.getElementById('percentageBasic');
    const basicIncrementInput = document.getElementById('basicIncrementAmount');
    const percentHouseRentInput = document.getElementById('percentageHouseRent');
    const houseRentIncrementInput = document.getElementById('incrementHouseRent');
    const percentFoodAllowanceInput = document.getElementById('percentageFoodAllowance');
    const foodAllowanceIncrementInput = document.getElementById('foodAllowanceIncrement');
    const percentTransportationAllowanceInput = document.getElementById('percentageTransportationAllowance');
    const transportationAllowanceIncrementInput = document.getElementById('transportationAllowanceIncrement');

    // Add change event listener to the employee dropdown
    employeeSelect.addEventListener('change', function () {
        updateIncrementFields();
    });

    // Add input event listeners to percentage and increment input fields
    percentBasicInput.addEventListener('input', function () {
        updateIncrementFields();
    });

    basicIncrementInput.addEventListener('input', function () {
        updateIncrementFields();
    });

    percentHouseRentInput.addEventListener('input', function () {
        updateIncrementFields();
    });

    houseRentIncrementInput.addEventListener('input', function () {
        updateIncrementFields();
    });

    percentFoodAllowanceInput.addEventListener('input', function () {
        updateIncrementFields();
    });

    foodAllowanceIncrementInput.addEventListener('input', function () {
        updateIncrementFields();
    });

    percentTransportationAllowanceInput.addEventListener('input', function () {
        updateIncrementFields();
    });

    transportationAllowanceIncrementInput.addEventListener('input', function () {
        updateIncrementFields();
    });

    // Function to update the increment fields based on the selected employee and percentages
    function updateIncrementFields() {
        const selectedOption = employeeSelect.options[employeeSelect.selectedIndex];
        const basicAmount = parseFloat(selectedOption.getAttribute('data-employee-basic_salary'));
        const houseRentAmount = parseFloat(selectedOption.getAttribute('data-employee-house_rent'));
        const foodAllowanceAmount = parseFloat(selectedOption.getAttribute('data-employee-food_allowance'));
        const transportationAllowanceAmount = parseFloat(selectedOption.getAttribute('data-employee-transportation_allowance'));

        let percentBasic = parseFloat(percentBasicInput.value);
        let basic_salary = parseFloat(basicIncrementInput.value);
        let percentHouseRent = parseFloat(percentHouseRentInput.value);
        let house_rent_increment = parseFloat(houseRentIncrementInput.value);
        let percentFoodAllowance = parseFloat(percentFoodAllowanceInput.value);
        let food_allowance_increment = parseFloat(foodAllowanceIncrementInput.value);
        let percentTransportationAllowance = parseFloat(percentTransportationAllowanceInput.value);
        let transportation_allowance_increment = parseFloat(transportationAllowanceIncrementInput.value);

        if (!isNaN(basicAmount)) {
            // Calculate basic salary increment
            if (!isNaN(percentBasic)) {
                basic_salary = (percentBasic / 100) * basicAmount;
                basicIncrementInput.value = basic_salary.toFixed(2);
            } else if (!isNaN(basic_salary)) {
                percentBasic = (basic_salary / basicAmount) * 100;
                percentBasicInput.value = percentBasic.toFixed(2);
            }

            // Calculate house rent increment
            if (!isNaN(percentHouseRent)) {
                house_rent_increment = (percentHouseRent / 100) * houseRentAmount;
                houseRentIncrementInput.value = house_rent_increment.toFixed(2);
            } else if (!isNaN(house_rent_increment)) {
                percentHouseRent = (house_rent_increment / houseRentAmount) * 100;
                percentHouseRentInput.value = percentHouseRent.toFixed(2);
            }

            // Calculate food allowance increment 
            if (!isNaN(percentFoodAllowance)) {
                food_allowance_increment = (percentFoodAllowance / 100) * foodAllowanceAmount;
                foodAllowanceIncrementInput.value = food_allowance_increment.toFixed(2);
            } else if (!isNaN(food_allowance_increment)) {
                percentFoodAllowance = (food_allowance_increment / foodAllowanceAmount) * 100;
                percentFoodAllowanceInput.value = percentFoodAllowance.toFixed(2);
            }

            // Calculate transportation allowance increment 
            if (!isNaN(percentTransportationAllowance)) {
                transportation_allowance_increment = (percentTransportationAllowance / 100) * transportationAllowanceAmount;
                transportationAllowanceIncrementInput.value = transportation_allowance_increment.toFixed(2);
            } else if (!isNaN(transportation_allowance_increment)) {
                percentTransportationAllowance = (transportation_allowance_increment / transportationAllowanceAmount) * 100;
                percentTransportationAllowanceInput.value = percentTransportationAllowance.toFixed(2);
            }
        }

        // Calculate the total increment
        let totalIncrement = 0;
        if (!isNaN(basic_salary)) {
            totalIncrement += basic_salary;
        }
        if (!isNaN(house_rent_increment)) {
            totalIncrement += house_rent_increment;
        }
        if (!isNaN(food_allowance_increment)) {
            totalIncrement += food_allowance_increment;
        }
        if (!isNaN(transportation_allowance_increment)) {
            totalIncrement += transportation_allowance_increment;
        }

        // Update the total_increment input field
        document.getElementById('totalIncrement').value = totalIncrement.toFixed(2);
    }
});