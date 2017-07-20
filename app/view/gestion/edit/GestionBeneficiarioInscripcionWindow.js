Ext.define('sisscsj.view.gestion.edit.GestionBeneficiarioInscripcionWindow', {
    extend: 'Ext.window.Window',
    alias: 'widget.gestion.edit.gestionbeneficiarioinscripcionwindow',
    requires: [
        'sisscsj.view.gestion.edit.GestionBeneficiarioInscripcionForm'
    ],
    iconCls: 'icon_user',
    width: 800,
    height: 150,
    modal: true,
    resizable: true,
    draggable: true,
    constrainHeader: true,
    layout: 'fit',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    // include form
                    xtype: 'gestion.edit.gestionbeneficiarioinscripcionform'
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    ui: 'footer',
                    items: [
                        {
                            xtype: 'button',
                            itemId: 'cancel',
                            text: 'Cancelar',
                            iconCls: 'icon_delete'
                        },
                        '->',
                        {
                            xtype: 'button',
                            itemId: 'save',
                            text: 'Guardar',
                            iconCls: 'icon_save'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});