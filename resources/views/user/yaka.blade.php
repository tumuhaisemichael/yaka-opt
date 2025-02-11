<x-app-layout>
     <div class="hidden md:flex" style="height: 100vh;">
        <nav class="bg-[#004d40] dark:bg-[#00332c]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">Appliances</h3>
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-user-edit me-2"></i>
                        {{ __('Yaka-Opt') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-home me-2"></i>
                        {{ __('Cost') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-plug me-2"></i>
                        {{ __('Appliance') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-link me-2"></i>
                        {{ __('Connected Devices') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-user-edit me-2"></i>
                        {{ __('Yaka') }}
                    </a>
                </li>
            </ul>
        </nav>

        <div class="flex-grow p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <h1 class="text-2xl font-bold text-[#004d40] text-center">Yaka Usage Calculator</h1>
                <p class="text-center mb-4">Select appliances and enter usage details to calculate Yaka units consumption.</p>

                <h2 class="text-lg font-semibold text-[#00796b]">Choose Your Appliances</h2>
                <div class="dropdown mb-4">
                    <select id="applianceDropdown" class="form-control" onchange="addAppliance()">
                        <option value="">-- Select an Appliance --</option>
                    </select>
                </div>

                <!-- Add this below the "Choose Your Appliances" section -->
                <h2 class="text-lg font-semibold text-[#00796b]">Load Saved Appliance List</h2>
                <div class="dropdown mb-4">
                    <select id="savedListsDropdown" class="form-control" onchange="loadSavedList()">
                        <option value="">-- Select a Saved List --</option>
                    </select>
                </div>

                <h2 class="text-lg font-semibold text-[#00796b]">Add Custom Appliance</h2>
                <div class="custom-appliance mb-4">
                    <input type="text" id="customApplianceName" placeholder="Enter Appliance Name" class="form-control mb-2" />
                    <input type="number" id="customAppliancePower" placeholder="Enter Power Usage (Watts)" class="form-control mb-2" />
                    <button class="btn w-100" onclick="addCustomAppliance()">Add Custom Appliance</button>
                </div>

                <h2 class="text-lg font-semibold text-[#00796b]">Set Usage Details</h2>
                <div id="applianceList" class="appliance-list mb-4"></div>

                <h2 class="text-lg font-semibold text-[#00796b]">Enter Usage Duration</h2>
                <div class="duration-input mb-4">
                    <input type="number" id="durationValue" placeholder="Enter Duration" class="form-control mb-2" />
                    <select id="durationUnit" class="form-control">
                        <option value="days">Days</option>
                        <option value="weeks">Weeks</option>
                        <option value="months">Months</option>
                    </select>
                </div>

                <button class="btn w-100" onclick="calculateUsage()">Calculate</button>
                <div id="result" class="result mt-4" style="display: none;"></div>
            </div>
        </div>
    </div>

    <script>
        const appliances = [
            { name: "Fridge", power: 150 },
            { name: "TV", power: 100 },
            { name: "Washing Machine", power: 500 },
            { name: "Electric Iron", power: 1000 },
            { name: "Microwave", power: 1200 },
            { name: "Laptop", power: 65 },
            { name: "Fan", power: 70 },
            { name: "Lights", power: 60 },
        ];

        const applianceDropdown = document.getElementById("applianceDropdown");
        const selectedAppliances = [];

        appliances.forEach((appliance, index) => {
            const option = document.createElement("option");
            option.value = index;
            option.textContent = appliance.name;
            applianceDropdown.appendChild(option);
        });

        function addAppliance() {
            const selectedIndex = applianceDropdown.value;
            if (selectedIndex === "") return;

            const appliance = appliances[selectedIndex];
            selectedAppliances.push(appliance);
            displayApplianceList();
            applianceDropdown.value = "";
        }

        function addCustomAppliance() {
            const name = document.getElementById("customApplianceName").value.trim();
            const power = parseFloat(document.getElementById("customAppliancePower").value);
            if (!name || isNaN(power) || power <= 0) {
                alert("Please enter a valid appliance name and power usage.");
                return;
            }
            selectedAppliances.push({ name, power });
            displayApplianceList();
        }

        function displayApplianceList() {
            const applianceList = document.getElementById("applianceList");
            applianceList.innerHTML = "";
            selectedAppliances.forEach((appliance, index) => {
                applianceList.innerHTML += `
                    <div class="appliance-row">
                        <span>${appliance.name} (${appliance.power}W):</span>
                        <input type="number" id="hours-${index}" placeholder="Hours/day" class="form-control" />
                    </div>`;
            });
        }

        // Add this to the existing script
        function populateSavedListsDropdown() {
            const savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];
            const dropdown = document.getElementById("savedListsDropdown");
            dropdown.innerHTML = "<option value=''>-- Select a Saved List --</option>";
            savedLists.forEach((list, index) => {
                const option = document.createElement("option");
                option.value = index;
                option.textContent = `List ${index + 1}`;
                dropdown.appendChild(option);
            });
        }

        // Call this function when the page loads
        populateSavedListsDropdown();


        // Add this to the existing script
        function loadSavedList() {
            const dropdown = document.getElementById("savedListsDropdown");
            const selectedIndex = dropdown.value;
            if (selectedIndex === "") return;

            const savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];
            const selectedList = savedLists[selectedIndex];

            // Clear the current selected appliances
            selectedAppliances.length = 0;

            // Add the appliances from the saved list
            selectedList.forEach(appliance => {
                selectedAppliances.push(appliance);
            });

            // Display the selected appliances
            displayApplianceList();
        }

        function displayApplianceList() {
    const applianceList = document.getElementById("applianceList");
    applianceList.innerHTML = "";
    selectedAppliances.forEach((appliance, index) => {
        applianceList.innerHTML += `
            <div class="appliance-row flex items-center justify-between bg-gray-100 p-3 rounded-lg shadow-md mb-3">
                <span class="text-lg font-semibold">${appliance.name} (${appliance.power}W):</span>
                <input type="number" id="hours-${index}" placeholder="Hours/day" class="form-control w-1/5 p-2 border border-gray-300 rounded-md" />

            </div>`;
    });
}

document.addEventListener("DOMContentLoaded", () => {
                populateSavedListsDropdown();
            });


        function calculateUsage() {
            let totalKwh = 0;
            let breakdown = "";
            selectedAppliances.forEach((appliance, index) => {
                const hours = parseFloat(document.getElementById(`hours-${index}`).value) || 0;
                const dailyKwh = (appliance.power / 1000) * hours;
                const totalApplianceKwh = dailyKwh * (document.getElementById("durationValue").value || 1);
                totalKwh += totalApplianceKwh;
                breakdown += `<p>${appliance.name}: ${totalApplianceKwh.toFixed(2)} kWh (${hours} hours/day). Daily usage: ${dailyKwh.toFixed(2)} kWh</p>`;
            });
            document.getElementById("result").innerHTML = `
                <h3>Total Units Consumed: ${totalKwh.toFixed(2)} kWh</h3>
                <h4>Total Units: ${totalKwh.toFixed(2)}</h4>
                <div>${breakdown}</div>`;
            document.getElementById("result").style.display = "block";
        }

                function calculateUsage() {
            let totalUnits = 0;
            let breakdown = "";
            selectedAppliances.forEach((appliance, index) => {
                const hours = parseFloat(document.getElementById(`hours-${index}`).value) || 0;
                const dailyUnits = (appliance.power / 1000) * hours; // Calculate daily units
                const totalApplianceUnits = dailyUnits * (document.getElementById("durationValue").value || 1); // Total units for the duration
                totalUnits += totalApplianceUnits;
                breakdown += `<p>${appliance.name}: ${totalApplianceUnits.toFixed(2)} units (${hours} hours/day). Daily usage: ${dailyUnits.toFixed(2)} units</p>`;
            });

            // Display the result in an overlay
            const overlay = document.createElement("div");
            overlay.style.position = "fixed";
            overlay.style.top = "0";
            overlay.style.left = "0";
            overlay.style.width = "100%";
            overlay.style.height = "100%";
            overlay.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
            overlay.style.color = "white";
            overlay.style.display = "flex";
            overlay.style.flexDirection = "column";
            overlay.style.justifyContent = "center";
            overlay.style.alignItems = "center";
            overlay.style.zIndex = "1000";

            const overlayContent = document.createElement("div");
            overlayContent.innerHTML = `
                <h3>Total Units Consumed: ${totalUnits.toFixed(2)} units</h3>
                <div>${breakdown}</div>
                <button id="closeOverlay" style="margin-top: 20px; padding: 10px 20px; font-size: 16px;">Close</button>
            `;
            overlay.appendChild(overlayContent);

            document.body.appendChild(overlay);

            // Close overlay and display result on the page
            document.getElementById("closeOverlay").addEventListener("click", () => {
                document.body.removeChild(overlay);

                // Display the result on the page
                document.getElementById("result").innerHTML = `
                    <h3>Total Units Consumed: ${totalUnits.toFixed(2)} units</h3>
                    <h4>Total Units: ${totalUnits.toFixed(2)}</h4>
                    <div>${breakdown}</div>
                    <button id="convertToUGX" style="margin-top: 20px; padding: 10px 20px; font-size: 16px;">Convert to UGX</button>
                `;
                document.getElementById("result").style.display = "block";

                // Add conversion functionality
                document.getElementById("convertToUGX").addEventListener("click", () => {
                    const exchangeRate = 803.0; // Example: 1 unit = 3800 UGX (replace with actual rate)
                    const totalUGX = totalUnits * exchangeRate;
                    document.getElementById("result").innerHTML += `
                        <h4>Total Cost: ${totalUGX.toFixed(2)} UGX</h4>
                    `;
                });

            });
        }
        </script>



    <!-- Mobile Layout -->
<div class="md:hidden">
    <div class="bg-[#004d40] p-4">
        <button id="menuToggle" class="text-white focus:outline-none">
            <i class="fas fa-bars"></i> Menu
        </button>
    </div>
    <div id="mobileMenu" class="hidden bg-[#004d40] p-4">
        <ul class="list-unstyled">
            <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400">Dashboard</a></li>
            <li><a href="{{ route('user.update') }}" class="text-gray-300 hover:text-blue-400">Yaka-Opt</a></li>
            <li><a href="{{ route('user.cost') }}" class="text-gray-300 hover:text-blue-400">Cost</a></li>
            <li><a href="{{ route('user.appliances') }}" class="text-gray-300 hover:text-blue-400">Appliance</a></li>
            <li><a href="{{ route('user.connect') }}" class="text-gray-300 hover:text-blue-400">Connected Devices</a></li>
            <li>
                <a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                    <i class="fas fa-user-edit me-2"></i>
                    {{ __('Yaka') }}
                </a>
            </li>
        </ul>
    </div>
    <div class="p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]">
        <div class="container bg-white rounded shadow-lg p-4">
            <h1 class="text-2xl font-bold text-[#004d40] text-center">Yaka Usage Calculator</h1>
            <p class="text-center mb-4">Enter appliances and usage details to calculate consumption.</p>

            <!-- Appliance Selection -->
            <h2 class="text-lg font-semibold text-[#00796b]">Choose Your Appliances</h2>
            <div class="dropdown mb-4">
                <select id="applianceDropdownMobile" class="form-control" onchange="addApplianceMobile()">
                    <option value="">-- Select an Appliance --</option>
                </select>
            </div>

            <!-- Add Custom Appliance -->
            <h2 class="text-lg font-semibold text-[#00796b]">Add Custom Appliance</h2>
            <div class="custom-appliance mb-4">
                <input type="text" id="customApplianceNameMobile" placeholder="Enter Appliance Name" class="form-control mb-2" />
                <input type="number" id="customAppliancePowerMobile" placeholder="Enter Power Usage (Watts)" class="form-control mb-2" />
                <button class="btn w-100" onclick="addCustomApplianceMobile()">Add Custom Appliance</button>
            </div>

            <!-- Appliance List -->
            <h2 class="text-lg font-semibold text-[#00796b]">Set Usage Details</h2>
            <div id="applianceListMobile" class="appliance-list mb-4"></div>

            <!-- Usage Duration -->
            <h2 class="text-lg font-semibold text-[#00796b]">Enter Usage Duration</h2>
            <div class="duration-input mb-4">
                <input type="number" id="durationValueMobile" placeholder="Enter Duration" class="form-control mb-2" />
                <select id="durationUnitMobile" class="form-control">
                    <option value="days">Days</option>
                    <option value="weeks">Weeks</option>
                    <option value="months">Months</option>
                </select>
            </div>

            <!-- Calculate Button -->
            <button class="btn w-100" onclick="calculateUsageMobile()">Calculate</button>

            <!-- Result Display -->
            <div id="resultMobile" class="result mt-4" style="display: none;"></div>
        </div>
    </div>
</div>

<script>
    // Appliance Data
    const appliances = [
        { name: "Fridge", power: 150 },
        { name: "TV", power: 100 },
        { name: "Washing Machine", power: 500 },
        { name: "Electric Iron", power: 1000 },
        { name: "Microwave", power: 1200 },
        { name: "Laptop", power: 65 },
        { name: "Fan", power: 70 },
        { name: "Lights", power: 60 },
    ];

    // Populate Appliance Dropdown for Mobile
    const applianceDropdownMobile = document.getElementById("applianceDropdownMobile");
    const selectedAppliancesMobile = [];

    appliances.forEach((appliance, index) => {
        const option = document.createElement("option");
        option.value = index;
        option.textContent = appliance.name;
        applianceDropdownMobile.appendChild(option);
    });

    // Add Appliance to List (Mobile)
    function addApplianceMobile() {
        const selectedIndex = applianceDropdownMobile.value;
        if (selectedIndex === "") return;

        const appliance = appliances[selectedIndex];
        selectedAppliancesMobile.push(appliance);
        displayApplianceListMobile();
        applianceDropdownMobile.value = "";
    }

    // Add Custom Appliance (Mobile)
    function addCustomApplianceMobile() {
        const name = document.getElementById("customApplianceNameMobile").value.trim();
        const power = parseFloat(document.getElementById("customAppliancePowerMobile").value);
        if (!name || isNaN(power) || power <= 0) {
            alert("Please enter a valid appliance name and power usage.");
            return;
        }
        selectedAppliancesMobile.push({ name, power });
        displayApplianceListMobile();
    }

    // Display Appliance List (Mobile)
    function displayApplianceListMobile() {
        const applianceListMobile = document.getElementById("applianceListMobile");
        applianceListMobile.innerHTML = "";
        selectedAppliancesMobile.forEach((appliance, index) => {
            applianceListMobile.innerHTML += `
                <div class="appliance-row">
                    <span>${appliance.name} (${appliance.power}W):</span>
                    <input type="number" id="hours-mobile-${index}" placeholder="Hours/day" class="form-control" />
                </div>`;
        });
    }

    // Calculate Usage (Mobile)
    function calculateUsageMobile() {
        let totalKwh = 0;
        let breakdown = "";
        selectedAppliancesMobile.forEach((appliance, index) => {
            const hours = parseFloat(document.getElementById(`hours-mobile-${index}`).value) || 0;
            const dailyKwh = (appliance.power / 1000) * hours;
            const totalApplianceKwh = dailyKwh * (document.getElementById("durationValueMobile").value || 1);
            totalKwh += totalApplianceKwh;
            breakdown += `<p>${appliance.name}: ${totalApplianceKwh.toFixed(2)} kWh (${hours} hours/day). Daily usage: ${dailyKwh.toFixed(2)} kWh</p>`;
        });
        document.getElementById("resultMobile").innerHTML = `
            <h3>Total Units Consumed: ${totalKwh.toFixed(2)} kWh</h3>
            <h4>Total Units: ${totalKwh.toFixed(2)}</h4>
            <div>${breakdown}</div>`;
        document.getElementById("resultMobile").style.display = "block";
    }

    // Toggle Mobile Menu
    document.getElementById("menuToggle").addEventListener("click", function() {
        document.getElementById("mobileMenu").classList.toggle("hidden");
    });
</script>
</x-app-layout>
