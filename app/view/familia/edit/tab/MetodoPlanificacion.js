Ext.define('sisscsj.view.familia.edit.tab.MetodoPlanificacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.familia.edit.tab.metodoplanificacion',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'sisscsj.store.opciones.MetodoPlanificacionFamiliar',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
                
        var storeMetodoPlanificacion = Ext.data.StoreManager.lookup('opciones.MetodoPlanificacionFamiliar');
        storeMetodoPlanificacion.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'itemselector',
                    itemId: 'familia_metodo_planificacion_familiar',
                    name: 'familia_metodo_planificacion_familiar',
                    anchor: '100%',
                    store: storeMetodoPlanificacion,
                    displayField: 'nombre_metodo_planificacion_familiar',
                    valueField: 'id_metodo_planificacion_familiar',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Métodos Disponibles',
                    toTitle: 'Métodos Seleccionados',
                    buttons: [ 'add', 'remove' ],
                    delimiter: null,
                    overflowY: 'scroll',
                    height: 350
                }
            ]
        });
        me.callParent(arguments);
    }
});