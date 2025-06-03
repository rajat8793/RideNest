function bookNow(type) {
  const name = prompt(`Enter your name to book a ${type}:`);
  if (name && name.trim() !== "") {
    fetch("../backend/book.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `name=${encodeURIComponent(name)}&type=${encodeURIComponent(type)}`
    })
    .then(res => res.text())
    .then(alert)
    .catch(() => alert("Failed to book. Please try again."));
  } else {
    alert("Name is required to proceed.");
  }
}
