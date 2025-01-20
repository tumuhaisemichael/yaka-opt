<x-app-layout>
    <div class="flex" style="height: 100vh;">
        <!-- Sidebar -->
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
            <i class="fas fa-home me-2"></i>  <!-- Updated icon for Cost -->
            {{ __('Cost') }}
        </a>
    </li>
    <!-- New Appliance Link -->
    <li>
        <a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
            <i class="fas fa-plug me-2"></i>
            {{ __('Appliance') }}
        </a>
    </li>
</ul>

        </nav>

        <!-- Main Content -->
        <div class="flex-grow p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <h1 class="text-2xl font-bold text-[#004d40] text-center">Customize Appliances</h1>
                <p class="text-center mb-4">Select the appliances you frequently use and save your preferences for future sessions.</p>

                <!-- Appliance Selection Section -->
                <div class="flex mb-4">
                    <!-- Left Column: Available Appliances -->
                    <div class="w-1/2 pr-4">
                        <h2 class="text-lg font-semibold text-[#00796b] mb-2">Available Appliances</h2>
                        <div id="availableAppliances"></div>
                    </div>

                    <!-- Right Column: Selected Appliances -->
                    <div class="w-1/2 pl-4">
                        <h2 class="text-lg font-semibold text-[#00796b] mb-2">Selected Appliances</h2>
                        <div id="selectedAppliances"></div>
                    </div>
                </div>

                <!-- Buttons in a Straight Line and Centered -->
                <div class="flex justify-center space-x-4 mb-4">
                    <button class="btn btn-warning w-auto" id="customApplianceButton" onclick="toggleCustomApplianceForm()">Add Custom Appliance</button>
                    <button class="btn btn-success w-auto" onclick="savePreferences()">Save Preferences</button>
                    <button id="viewSavedListButton" class="btn btn-primary w-auto" onclick="viewSavedLists()">View Saved Lists</button>
                </div>

                <!-- Custom Appliance Form -->
                <div id="customApplianceForm" class="hidden">
                    <input type="text" id="customApplianceName" placeholder="Enter Appliance Name" class="form-control mb-2" />
                    <input type="number" id="customAppliancePower" placeholder="Enter Power Usage (Watts)" class="form-control mb-2" />
                    <button class="btn btn-warning w-1/2 mb-4" onclick="addCustomAppliance()">Add Custom Appliance</button>
                </div>

                <!-- Saved Preferences -->
                <div id="savedLists" class="result mt-4" style="display: none;"></div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
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

        const availableAppliancesElement = document.getElementById("availableAppliances");
        const selectedAppliancesElement = document.getElementById("selectedAppliances");
        const savedListsElement = document.getElementById("savedLists");
        const viewSavedListButton = document.getElementById("viewSavedListButton");

        const selectedAppliances = [];
        const savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];

        // Display available appliances
        function displayAvailableAppliances() {
            availableAppliancesElement.innerHTML = appliances.map((appliance, index) => `
                <div class="appliance-row mb-2 flex justify-between">
                    <span>${appliance.name} (${appliance.power}W)</span>
                    <button class="btn btn-sm btn-success" onclick="addToSelected(${index})">Add</button>
                </div>
            `).join("");
        }

        // Display selected appliances
        function displaySelectedAppliances() {
            selectedAppliancesElement.innerHTML = selectedAppliances.map((appliance, index) => `
                <div class="appliance-row mb-2 flex justify-between">
                    <span>${appliance.name} (${appliance.power}W)</span>
                    <button class="btn btn-sm btn-danger" onclick="removeFromSelected(${index})">Remove</button>
                </div>
            `).join("");
        }

        // Add appliance to selected list
        function addToSelected(index) {
            const appliance = appliances[index];
            if (!selectedAppliances.includes(appliance)) {
                selectedAppliances.push(appliance);
                displaySelectedAppliances();
            }
        }

        // Remove appliance from selected list
        function removeFromSelected(index) {
            selectedAppliances.splice(index, 1);
            displaySelectedAppliances();
        }

        // Add custom appliance
        function addCustomAppliance() {
            const name = document.getElementById("customApplianceName").value.trim();
            const power = parseFloat(document.getElementById("customAppliancePower").value);
            if (!name || isNaN(power) || power <= 0) {
                alert("Please enter a valid appliance name and power usage.");
                return;
            }

            const customAppliance = { name, power };
            selectedAppliances.push(customAppliance);
            displaySelectedAppliances();
            alert(`Custom appliance "${name}" added to the selected list!`);

            toggleCustomApplianceForm(); // Collapse the form back to button
        }

        // Toggle custom appliance form visibility
        function toggleCustomApplianceForm() {
            const form = document.getElementById("customApplianceForm");
            const button = document.getElementById("customApplianceButton");
            if (form.classList.contains("hidden")) {
                form.classList.remove("hidden");
                button.classList.add("hidden");
            } else {
                form.classList.add("hidden");
                button.classList.remove("hidden");
            }
        }

        // Save preferences
        function savePreferences() {
            if (selectedAppliances.length === 0) {
                alert("Please select at least one appliance.");
                return;
            }

            savedLists.push([...selectedAppliances]);
            localStorage.setItem("applianceLists", JSON.stringify(savedLists));
            alert("Preferences saved as a new list!");
            displaySavedLists();
        }

        // Delete saved list
        function deleteSavedList(index) {
            savedLists.splice(index, 1);
            localStorage.setItem("applianceLists", JSON.stringify(savedLists));
            displaySavedLists(); // Update the display
        }

        // Display saved lists in 3 columns with delete icon
        function displaySavedLists() {
            if (savedLists.length === 0) {
                savedListsElement.innerHTML = "<p>No lists saved yet.</p>";
            } else {
                savedListsElement.innerHTML = `
                    <div class="flex flex-wrap gap-4">
                        ${savedLists.map((list, i) => `
                            <div class="mb-3 p-3 border rounded flex justify-between w-1/3 relative">
                                <div>
                                    <h4>List ${i + 1}</h4>
                                    <ul>
                                        ${list.map(a => `<li>${a.name} (${a.power}W)</li>`).join("")}
                                    </ul>
                                </div>
                                <button class="btn text-red-500 absolute top-0 right-0 text-3xl" style="background: none; border: none;" onclick="deleteSavedList(${i})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        `).join("")}
                    </div>
                `;
            }
        }

        // View saved lists
        function viewSavedLists() {
            const isHidden = savedListsElement.style.display === "none" || savedListsElement.style.display === "";
            savedListsElement.style.display = isHidden ? "block" : "none";
        }

        // Initial render
        displayAvailableAppliances();
        displaySavedLists();
    </script>
</x-app-layout>
