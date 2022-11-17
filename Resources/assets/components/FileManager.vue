<script>
    import $ from 'jquery'
    
    export default {
        methods: {
            lfmInput: function(e){
                e.preventDefault();

                window.objInputFileManager = $('#'+$(e.target).attr('data-input'));
                window.objPreviewFileManager = $('#'+$(e.target).attr('data-preview'));
                window.open('/file-manager/fm-button?leftDisk='+this.$route.meta.DISK+'&rightDisk='+this.$route.meta.DISK, 'fm', 'width=800,height=600');
            }
        },
    }
</script>