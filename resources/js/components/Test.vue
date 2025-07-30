<template>
    <div>
        <div class="hexagone"></div>
        <div class="triangle"></div>
        <div class="star" style="color: gold"></div>
        <div class="arrow" style="color: green"></div>
        <div class="custom"></div>
        <div class="custom-polugon"></div>

        <svg
            style="visibility: hidden; position: absolute"
            width="0"
            height="0"
            xmlns="http://www.w3.org/2000/svg"
            version="1.1"
        >
            <defs>
                <filter id="round">
                    <feGaussianBlur
                        in="SourceGraphic"
                        stdDeviation="5"
                        result="blur"
                    />
                    <feColorMatrix
                        in="blur"
                        mode="matrix"
                        values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9"
                        result="goo"
                    />
                    <feComposite in="SourceGraphic" in2="goo" operator="atop" />
                </filter>
            </defs>
        </svg>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
div[class] {
    display: inline-block;
    width: 150px;
    color: red;
    margin: 20px;
    filter: url(#round);
}
.hexagone::before {
    content: "";
    display: block;
    padding-top: 86.6%;
    background: currentColor;
    clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
}

.custom-polugon:before {
    content: "";
    display: block;
    padding-top: 86.6%;
    background: currentColor;
    clip-path: polygon(
        0% 15%,
        15% 15%,
        15% 0%,
        85% 0%,
        85% 15%,
        100% 15%,
        100% 85%,
        85% 85%,
        85% 100%,
        15% 100%,
        15% 85%,
        0% 85%
    );
}
.triangle::before {
    content: "";
    display: block;
    padding-top: 86.6%;
    background: url(https://picsum.photos/id/1061/300/300) center/cover;
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
}
.star::before {
    content: "";
    display: block;
    padding-top: 100%;
    background: currentColor;
    clip-path: polygon(
        50% 0%,
        61% 35%,
        98% 35%,
        68% 57%,
        79% 91%,
        50% 70%,
        21% 91%,
        32% 57%,
        2% 35%,
        39% 35%
    );
}
.arrow::before {
    content: "";
    display: block;
    padding-top: 70%;
    background: currentColor;
    clip-path: polygon(
        40% 0%,
        40% 40%,
        100% 40%,
        100% 60%,
        40% 60%,
        40% 100%,
        0% 50%
    );
}
.custom::before {
    content: "";
    display: block;
    padding-top: 100%;
    background: conic-gradient(at 53% 47%, orange, pink, purple);
    clip-path: polygon(
        50% 0%,
        50% 50%,
        100% 60%,
        75% 100%,
        25% 100%,
        0% 60%,
        10% 20%
    );
}
</style>
