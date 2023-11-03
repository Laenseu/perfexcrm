function calculateRealizationRate(billableHours, totalHoursWorked) {
    return (billableHours / totalHoursWorked) * 100;
}

function updateProgress(rate) {
    const progressBar = document.getElementById("progress");
    const rateElement = document.getElementById("rate");

    progressBar.style.width = rate + "%";
    rateElement.textContent = rate.toFixed(2) + "%";
}

// Replace with your actual billable hours and total hours worked
const billableHours = 250; // Example value, replace with actual value
const totalHoursWorked = 300; // Example value, replace with actual value

// Calculate realization rate
const realizationRate = calculateRealizationRate(billableHours, totalHoursWorked);

// Update progress bar with calculated rate with animation
updateProgress(realizationRate);
