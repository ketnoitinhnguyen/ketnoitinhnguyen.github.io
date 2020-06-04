
document.getElementById('myBtn').addEventListener("click", function () {
    document.querySelector('.container').style.display = "block";
});
document.querySelector('.close').addEventListener('click', function () {
    document.querySelector('.container').style.display = "none";
});
document.getElementById('login').addEventListener("click", function () {
    document.querySelector('.container2').style.display = "block";
});
document.querySelector('.off').addEventListener('click', function () {
    document.querySelector('.container2').style.display = "none";
});