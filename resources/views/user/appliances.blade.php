<x-app-layout>
    <!-- Desktop Layout -->
    <div class="hidden md:flex" style="height: 100vh;">
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

    <!-- Mobile Layout -->
    <div class="md:hidden">
        <!-- Mobile Header -->
        <div class="bg-[#004d40] p-4">
            <button id="menuToggleMobile" class="text-white focus:outline-none">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenuMobile" class="hidden bg-[#004d40] p-4">
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
        </div>

        <!-- Main Content -->
        <div class="p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <h1 class="text-2xl font-bold text-[#004d40] text-center">Customize Appliances</h1>
                <p class="text-center mb-4">Select the appliances you frequently use and save your preferences for future sessions.</p>

                <!-- Appliance Selection Section -->
                <div class="flex flex-col mb-4">
                    <!-- Available Appliances -->
                    <div class="w-full mb-4">
                        <h2 class="text-lg font-semibold text-[#00796b] mb-2">Available Appliances</h2>
                        <div id="availableAppliancesMobile"></div>
                    </div>

                    <!-- Selected Appliances -->
                    <div class="w-full">
                        <h2 class="text-lg font-semibold text-[#00796b] mb-2">Selected Appliances</h2>
                        <div id="selectedAppliancesMobile"></div>
                    </div>
                </div>

                <!-- Buttons in a Straight Line and Centered -->
                <div class="flex flex-col space-y-4 mb-4">
                    <button class="btn btn-warning w-full" id="customApplianceButtonMobile" onclick="toggleCustomApplianceFormMobile()">Add Custom Appliance</button>
                    <button class="btn btn-success w-full" onclick="savePreferencesMobile()">Save Preferences</button>
                    <button id="viewSavedListButtonMobile" class="btn btn-primary w-full" onclick="viewSavedListsMobile()">View Saved Lists</button>
                </div>

                <!-- Custom Appliance Form -->
                <div id="customApplianceFormMobile" class="hidden">
                    <input type="text" id="customApplianceNameMobile" placeholder="Enter Appliance Name" class="form-control mb-2" />
                    <input type="number" id="customAppliancePowerMobile" placeholder="Enter Power Usage (Watts)" class="form-control mb-2" />
                    <button class="btn btn-warning w-full mb-4" onclick="addCustomApplianceMobile()">Add Custom Appliance</button>
                </div>

                <!-- Saved Preferences -->
                <div id="savedListsMobile" class="result mt-4" style="display: none;"></div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
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

        // Desktop Elements
        const availableAppliancesElement = document.getElementById("availableAppliances");
        const selectedAppliancesElement = document.getElementById("selectedAppliances");
        const savedListsElement = document.getElementById("savedLists");

        // Mobile Elements
        const availableAppliancesElementMobile = document.getElementById("availableAppliancesMobile");
        const selectedAppliancesElementMobile = document.getElementById("selectedAppliancesMobile");
        const savedListsElementMobile = document.getElementById("savedListsMobile");

        const selectedAppliances = [];
        const savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];

        // Display available appliances (Desktop)
        function displayAvailableAppliances() {
            availableAppliancesElement.innerHTML = appliances.map((appliance, index) => `
                <div class="appliance-row mb-2 flex justify-between">
                    <span>${appliance.name} (${appliance.power}W)</span>
                    <button class="btn btn-sm btn-success" onclick="addToSelected(${index})">Add</button>
                </div>
            `).join("");
        }

        // Display selected appliances (Desktop)
        function displaySelectedAppliances() {
            selectedAppliancesElement.innerHTML = selectedAppliances.map((appliance, index) => `
                <div class="appliance-row mb-2 flex justify-between">
                    <span>${appliance.name} (${appliance.power}W)</span>
                    <button class="btn btn-sm btn-danger" onclick="removeFromSelected(${index})">Remove</button>
                </div>
            `).join("");
        }

        // Display available appliances (Mobile)
        function displayAvailableAppliancesMobile() {
            availableAppliancesElementMobile.innerHTML = appliances.map((appliance, index) => `
                <div class="appliance-row mb-2 flex justify-between">
                    <span>${appliance.name} (${appliance.power}W)</span>
                    <button class="btn btn-sm btn-success" onclick="addToSelectedMobile(${index})">Add</button>
                </div>
            `).join("");
        }

        // Display selected appliances (Mobile)
        function displaySelectedAppliancesMobile() {
            selectedAppliancesElementMobile.innerHTML = selectedAppliances.map((appliance, index) => `
                <div class="appliance-row mb-2 flex justify-between">
                    <span>${appliance.name} (${appliance.power}W)</span>
                    <button class="btn btn-sm btn-danger" onclick="removeFromSelectedMobile(${index})">Remove</button>
                </div>
            `).join("");
        }

        // Add appliance to selected list (Desktop)
        function addToSelected(index) {
            const appliance = appliances[index];
            if (!selectedAppliances.includes(appliance)) {
                selectedAppliances.push(appliance);
                displaySelectedAppliances();
                displaySelectedAppliancesMobile(); // Sync with mobile
            }
        }

        // Remove appliance from selected list (Desktop)
        function removeFromSelected(index) {
            selectedAppliances.splice(index, 1);
            displaySelectedAppliances();
            displaySelectedAppliancesMobile(); // Sync with mobile
        }

        // Add appliance to selected list (Mobile)
        function addToSelectedMobile(index) {
            const appliance = appliances[index];
            if (!selectedAppliances.includes(appliance)) {
                selectedAppliances.push(appliance);
                displaySelectedAppliancesMobile();
                displaySelectedAppliances(); // Sync with desktop
            }
        }

        // Remove appliance from selected list (Mobile)
        function removeFromSelectedMobile(index) {
            selectedAppliances.splice(index, 1);
            displaySelectedAppliancesMobile();
            displaySelectedAppliances(); // Sync with desktop
        }

        // Add custom appliance (Desktop)
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

        // Toggle custom appliance form visibility (Desktop)
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

        // Add custom appliance (Mobile)
        function addCustomApplianceMobile() {
            const name = document.getElementById("customApplianceNameMobile").value.trim();
            const power = parseFloat(document.getElementById("customAppliancePowerMobile").value);
            if (!name || isNaN(power) || power <= 0) {
                alert("Please enter a valid appliance name and power usage.");
                return;
            }

            const customAppliance = { name, power };
            selectedAppliances.push(customAppliance);
            displaySelectedAppliancesMobile();
            alert(`Custom appliance "${name}" added to the selected list!`);

            toggleCustomApplianceFormMobile(); // Collapse the form back to button
        }

        // Toggle custom appliance form visibility (Mobile)
        function toggleCustomApplianceFormMobile() {
            const form = document.getElementById("customApplianceFormMobile");
            const button = document.getElementById("customApplianceButtonMobile");
            if (form.classList.contains("hidden")) {
                form.classList.remove("hidden");
                button.classList.add("hidden");
            } else {
                form.classList.add("hidden");
                button.classList.remove("hidden");
            }
        }

        // Save preferences (Desktop)
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

        // Save preferences (Mobile)
        function savePreferencesMobile() {
            if (selectedAppliances.length === 0) {
                alert("Please select at least one appliance.");
                return;
            }

            savedLists.push([...selectedAppliances]);
            localStorage.setItem("applianceLists", JSON.stringify(savedLists));
            alert("Preferences saved as a new list!");
            displaySavedListsMobile();
        }

        // Delete saved list (Desktop)
        function deleteSavedList(index) {
            savedLists.splice(index, 1);
            localStorage.setItem("applianceLists", JSON.stringify(savedLists));
            displaySavedLists(); // Update the display
        }

        // Delete saved list (Mobile)
        function deleteSavedListMobile(index) {
            savedLists.splice(index, 1);
            localStorage.setItem("applianceLists", JSON.stringify(savedLists));
            displaySavedListsMobile(); // Update the display
        }

        // Display saved lists (Desktop)
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

        // Display saved lists (Mobile)
        function displaySavedListsMobile() {
            if (savedLists.length === 0) {
                savedListsElementMobile.innerHTML = "<p>No lists saved yet.</p>";
            } else {
                savedListsElementMobile.innerHTML = `
                    <div class="flex flex-col gap-4">
                        ${savedLists.map((list, i) => `
                            <div class="mb-3 p-3 border rounded flex justify-between relative">
                                <div>
                                    <h4>List ${i + 1}</h4>
                                    <ul>
                                        ${list.map(a => `<li>${a.name} (${a.power}W)</li>`).join("")}
                                    </ul>
                                </div>
                                <button class="btn text-red-500 absolute top-0 right-0 text-3xl" style="background: none; border: none;" onclick="deleteSavedListMobile(${i})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        `).join("")}
                    </div>
                `;
            }
        }

        // View saved lists (Desktop)
        function viewSavedLists() {
            const isHidden = savedListsElement.style.display === "none" || savedListsElement.style.display === "";
            savedListsElement.style.display = isHidden ? "block" : "none";
        }

        // View saved lists (Mobile)
        function viewSavedListsMobile() {
            const isHidden = savedListsElementMobile.style.display === "none" || savedListsElementMobile.style.display === "";
            savedListsElementMobile.style.display = isHidden ? "block" : "none";
        }

        // Toggle mobile menu
        document.getElementById("menuToggleMobile").addEventListener("click", () => {
            const mobileMenu = document.getElementById("mobileMenuMobile");
            mobileMenu.classList.toggle("hidden");
        });

        // Initial render
        displayAvailableAppliances();
        displaySelectedAppliances();
        displayAvailableAppliancesMobile();
        displaySelectedAppliancesMobile();
        displaySavedLists();
        displaySavedListsMobile();
    </script>
</x-app-layout>
