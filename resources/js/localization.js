export default {
   methods: {
        /**
         * Translate the given key.
         */
        __(key, replace = {}) {
            var keys = key.split('.');
            var translation = this.$page.props.language;
            keys.forEach(function(keyTmp){
                if(translation[keyTmp]){
                    if((typeof translation[keyTmp] == 'string')){
                        var options = translation[keyTmp].split('|');
                        translation = options[0]
                    }else{
                    translation = translation[keyTmp]
                    }
                }else{
                    translation = keyTmp
                }
            });

            Object.keys(replace).forEach(function (key) {
                translation = translation.replace(':' + key, replace[key])
            });

            return translation
        },

        /**
         * Translate the given key with basic pluralization.
         */
        __n(key, replace = {}) {
            var keys = key.split('.');
            var translation = this.$page.props.language;
            keys.forEach(function(keyTmp){
                if(translation[keyTmp]){
                    if((typeof translation[keyTmp] == 'string')){
                        var options = translation[keyTmp].split('|');
                        translation =  options[1] ?? options[0]
                    }else{
                    translation = translation[keyTmp]
                    }
                }else{
                    translation = keyTmp
                }
            });

            Object.keys(replace).forEach(function (key) {
                translation = translation.replace(':' + key, replace[key])
            });

            return translation
        },
    },
}
