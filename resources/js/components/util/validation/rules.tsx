const basic_rule = {
    required: value => !!value || 'Required.',
    // max: (value, length) => value.length <= length || 'Max ' + length + ' characters',
    max: (length) => (value) => (value ? value.length : 0) <= length || 'Max ' + length + ' characters',
    email: value => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return pattern.test(value) || 'Invalid e-mail.'
    },

}

const custom_rule = {
    password_match: (val) => (value) => val === value || 'Password not match',
    password_required: (val) => (value) => ((!!value || !val) || 'Required.'),
}

export {
    basic_rule, custom_rule
};
