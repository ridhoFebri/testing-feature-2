document.getElementById("generateTokenBtn").addEventListener("click", async () => {
    const response = await fetch("/generate-token");
    const data = await response.json();
    document.getElementById("token").innerText = data.token;
  });
  