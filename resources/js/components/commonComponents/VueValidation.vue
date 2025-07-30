<template>
    <span
        class="error"
        v-if="
            !nestedName.required &&
            nestedName.$dirty &&
            validation.includes('required')
        "
    >
        This feild is required
    </span>
    <span
        class="error"
        v-else-if="
            !nestedName.minLength &&
            nestedName.$dirty &&
            validation.includes('minLength')
        "
    >
        This feild must have at least
        {{ nestedName.$params.minLength.min }}
        characters.
    </span>
    <span
        class="error"
        v-else-if="
            !nestedName.maxLength &&
            nestedName.$dirty &&
            validation.includes('maxLength')
        "
    >
        This feild must be only
        {{ nestedName.$params.maxLength.max }}
        characters.
    </span>
    <span
        class="error"
        v-else-if="
            !nestedName.alpha_num &&
            nestedName.$dirty &&
            validation.includes('alpha_num')
        "
    >
        This feild must be in an alpha numeric format.
    </span>
    <span
        class="error"
        v-else-if="
            !nestedName.alpha &&
            nestedName.$dirty &&
            validation.includes('alpha')
        "
    >
        This feild must be in letters.
    </span>
    <span
        class="error"
        v-else-if="
            !nestedName.email &&
            nestedName.$dirty &&
            validation.includes('email')
        "
    >
        This feild must be an email.
    </span>
    <span
        class="error"
        v-else-if="
            !nestedName.numeric &&
            nestedName.$dirty &&
            validation.includes('numeric')
        "
    >
        This feild must be a number.
    </span>
    <span
        class="error"
        v-else-if="
            !nestedName.digits_validate &&
            nestedName.$dirty &&
            validation.includes('digits_validate')
        "
    >
        This feild must be 10 digits.
    </span>
    <span
        class="error"
        v-else-if="
            !nestedName.url && nestedName.$dirty && validation.includes('url')
        "
    >
        This feild must be a valid URL.
    </span>
</template>

<script>
export default {
    props: {
        instance: Object,
        nestedName: Object,
        validation: Array,
    },

    data() {
        return {};
    },

    computed: {},
};
</script>

<style scoped>
.error {
    font-size: 10px;
    color: #f57f6c;
}
</style>
