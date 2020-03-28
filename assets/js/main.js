function ready(f) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(f, 1);
    } else {
        document.addEventListener("DOMContentLoaded", f);
    }
}