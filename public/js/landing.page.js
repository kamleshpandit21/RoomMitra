const counters = document.querySelectorAll(".counter");
const speed = 200; // lower = faster

const animateCounters = () => {
    counters.forEach((counter) => {
        const updateCount = () => {
            const target = +counter.getAttribute("data-target");
            const count = +counter.innerText;
            const inc = Math.ceil(target / speed);

            if (count < target) {
                counter.innerText = count + inc;
                setTimeout(updateCount, 30);
            } else {
                counter.innerText = target + "+";
            }
        };
        updateCount();
    });
};

let started = false;
window.addEventListener("scroll", () => {
    const statsSection = document.getElementById("stats");
    const sectionTop = statsSection.getBoundingClientRect().top;
    const screenHeight = window.innerHeight;

    if (!started && sectionTop < screenHeight) {
        started = true;
        animateCounters();
    }
});