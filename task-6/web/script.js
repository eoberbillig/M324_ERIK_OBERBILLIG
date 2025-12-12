const toggle = document.getElementById("themeToggle");

// Initialer Text beim Laden
updateToggleText();

toggle.addEventListener("click", () => {
    document.body.classList.toggle("dark");
    updateToggleText();
});

function updateToggleText() {
    if (document.body.classList.contains("dark")) {
        toggle.textContent = "☀ Light";
    } else {
        toggle.textContent = "🌙 Dark";
    }
}

const search = document.getElementById("search");
search.oninput = () => {
    document.querySelectorAll("tbody tr").forEach(row => {
        row.style.display =
            row.innerText.toLowerCase().includes(search.value.toLowerCase())
                ? "" : "none";
    });
};

function editUser(id, name, email) {
    document.getElementById("modal").classList.add("active");
    document.getElementById("edit-id").value = id;
    document.getElementById("edit-name").value = name;
    document.getElementById("edit-email").value = email;
}

function closeModal() {
    document.getElementById("modal").classList.remove("active");
}
