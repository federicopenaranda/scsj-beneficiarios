/**
 * Main panel for displaying images for {@link CarTracker.model.Car} records
 */
Ext.define('sisscsj.view.beneficiario.edit.tab.Telefonos', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.telefonos',
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'beneficiario.listatelefono',
                    title: 'Administración de Teléfonos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.BeneficiarioTelefono', {
                        pageSize: 10,
                        remoteSort: false
                    })
                }
            ]
        });
        me.callParent(arguments);
    }
});