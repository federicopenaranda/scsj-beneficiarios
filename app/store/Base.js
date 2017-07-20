Ext.define('sisscsj.store.Base', {
    extend: 'Ext.data.Store',
    requires: [
        'sisscsj.proxy.JSON'
    ],
    serverPath: 'http://190.181.18.240/sisscsj/yii/index.php/',
    //serverPath: 'http://sistema.sociedadsanjose.org/sisscsj/yii/index.php/',

    //serverPath: 'http://192.168.1.110:8080/sisscsj/yii/index.php/',
    //serverPath: 'http://192.168.65.129/sisscsj/sisscsj/yii/index.php/',
    //serverPath: 'http://192.168.146.128/sisscsj/sisscsj/yii/index.php/',
    //serverPath: 'http://200.105.158.70:8080/sisscsj/yii/index.php/',
    restPath: null,
    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
                storeId: 'Base',
                remoteSort: true,
                remoteFilter: true,
                remoteGroup: true,
                proxy: {
                    type: 'basejson',
                    url: me.restPath,
                    api: {
                        create: me.serverPath + me.restPath + '/create',
                        read: me.serverPath + me.restPath,
                        update: me.serverPath + me.restPath + '/update',
                        destroy: me.serverPath + me.restPath + '/delete'
                    }
                }
            }, cfg)]);
    }
});