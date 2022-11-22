const Dashboard = () => import('../components/Dashboard.vue')
const ModuleMaster = () => import('../components/Module/Master.vue')
const ModuleForm = () => import('../components/Module/Form.vue')
const Setting = () => import('../components/Setting.vue')
const Fm = () => import('../components/Fm.vue')

export default class routes{
    constructor(Meta) {
        this.meta = Meta;
    }

    route(){
        return [
            {
                path: 'dashboard',
                name: 'dashboard',
                components : {
                    content : Dashboard,
                },
                meta: {...this.meta, title_dashboard: 'Dashboard'}
            },
            {
                path: 'setting',
                name: 'setting',
                components : {
                    content : Setting,
                },
                meta: {...this.meta, title_dashboard: 'Setting'}
            },
            {
                path: 'module/master',
                name: 'module-master',
                components : {
                    content : ModuleMaster,
                },
                props: { content: true },
                meta: {...this.meta, title_dashboard: 'Module'}
            },
            {
                path: 'module/form',
                name: 'module-form',
                components : {
                    content : ModuleForm,
                },
                meta: {...this.meta, title_dashboard: 'Module'}
            },
            {
                path: 'file-manager',
                name: 'file-manager',
                components : {
                    content : Fm,
                },
                meta: {...this.meta, title_dashboard: 'File Manager'}
            },
        ]
    }
}