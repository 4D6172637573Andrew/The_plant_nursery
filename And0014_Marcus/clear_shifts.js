document.addEventListener("DOMContentLoaded", () => {
    const c = document.getElementById("btn_delete_shift");
    c.addEventListener("click", async () => {
        if (confirm("Clear all shifts?") && (await fetch("clear_shifts.php", {method: "POST"})).ok) location.reload();
    });
});