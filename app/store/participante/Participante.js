Ext.define('sisscsj.store.participante.Participante', {
    extend: 'Ext.data.Store',
    alias: 'store.participante.participante',
    requires: [
        'sisscsj.model.participante.Participante',
        'sisscsj.proxy.JSON'
    ],
    storeId: 'Participante',
    model: 'sisscsj.model.participante.Participante',
    proxy: {
        type: 'basejson',
        url: 'beneficiario/beneficiarioProyecto',
        api: {
            /*create: 'http://192.168.1.110:8080/sisscsj/yii/index.php/Beneficiario/create',
            read: 'http://192.168.1.110:8080/sisscsj/yii/index.php/beneficiario/beneficiarioProyecto',
            update: 'http://192.168.1.110:8080/sisscsj/yii/index.php/Beneficiario/update',
            destroy: 'http://192.168.1.110:8080/sisscsj/yii/index.php/Beneficiario/delete'*/

            /*create: 'http://192.168.100.102/sisscsj/yii/index.php/Beneficiario/create',
            read: 'http://192.168.100.102/sisscsj/yii/index.php/beneficiario/beneficiarioProyecto',
            update: 'http://192.168.100.102/sisscsj/yii/index.php/Beneficiario/update',
            destroy: 'http://192.168.100.102/sisscsj/yii/index.php/Beneficiario/delete'*/
            
            /*create: 'http://sistema.sociedadsanjose.org/sisscsj/yii/index.php/Beneficiario/create',
            read: 'http://sistema.sociedadsanjose.org/sisscsj/yii/index.php/beneficiario/beneficiarioProyecto',
            update: 'http://sistema.sociedadsanjose.org/sisscsj/yii/index.php/Beneficiario/update',
            destroy: 'http://sistema.sociedadsanjose.org/sisscsj/yii/index.php/Beneficiario/delete'*/

            /*create: 'http://200.105.158.70:8080/sisscsj/yii/index.php/Beneficiario/create',
            read: 'http://200.105.158.70:8080/sisscsj/yii/index.php/beneficiario/beneficiarioProyecto',
            update: 'http://200.105.158.70:8080/sisscsj/yii/index.php/Beneficiario/update',
            destroy: 'http://200.105.158.70:8080/sisscsj/yii/index.php/Beneficiario/delete'*/

            create: 'http://190.181.18.240/sisscsj/yii/index.php/Beneficiario/create',
            read: 'http://190.181.18.240/sisscsj/yii/index.php/beneficiario/beneficiarioProyecto',
            update: 'http://190.181.18.240/sisscsj/yii/index.php/Beneficiario/update',
            destroy: 'http://190.181.18.240/sisscsj/yii/index.php/Beneficiario/delete'
        }
    }
});