// views
const Login = require('./module/guest/Login.vue').default;
const AdminLayout = require('./module/admin/AdminLayout').default;
const PracticeProfile = require('./module/admin/PracticeProfile').default;
const TeamMember = require('./module/admin/TeamMember').default;

// components
const Segment = require('./module/admin/component/Segment').default;

export default {
    Login,
    AdminLayout,
    PracticeProfile,
    TeamMember,

    Segment
}
