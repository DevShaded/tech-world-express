module.exports = {
    env: {
        node: true,
    },
    parser: "vue-eslint-parser",
    parserOptions: {
        parser: "@typescript-eslint/parser",
        ecmaVersion: 2020,
        sourceType: "module",
    },
    extends: [
        'eslint:recommended',
        'plugin:@typescript-eslint/recommended',
        'plugin:vue/vue3-recommended',
        'plugin:vue/base',
        'prettier',
    ],
    rules: {
        // override/add rules settings here, such as:
        // 'vue/no-unused-vars': 'error'
    }
}
