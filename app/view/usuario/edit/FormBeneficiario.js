Ext.define('sisscsj.view.usuario.edit.FormBeneficiario', {
    extend: 'Ext.form.Panel',
    alias: 'widget.usuario.edit.formbeneficiario',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: true,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            defaults: {
                layout: 'hbox',
                margins: '0 10 0 10'
            },
            items: [
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_beneficiario',
                            id: 'fk_id_beneficiario',
                            fieldLabel: 'Miembro:',
                            displayTpl: Ext.create('Ext.XTemplate',
                                        '<tpl for=".">',
                                            '{primer_nombre_beneficiario} {segundo_nombre_beneficiario} {apellido_paterno_beneficiario} {apellido_materno_beneficiario} ({codigo_beneficiario})',
                                        '</tpl>'),
                            tpl: '<tpl for="."><div class="x-boundlist-item" >{primer_nombre_beneficiario} {segundo_nombre_beneficiario} {apellido_paterno_beneficiario} {apellido_materno_beneficiario} ({codigo_beneficiario})</div></tpl>',
                            valueField: 'id_beneficiario',
                            store: {
                                type: 'usuario.usuariobeneficiariogestion'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'combo',
                            name: 'estado_usuario_beneficiario',
                            fieldLabel: 'Estado:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: LocalStoreEstado,
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }
                    ]
                },
                {
                    xtype: 'hiddenfield',
                    name: 'fk_id_gestion_beneficiario',
                    id: 'fk_id_gestion_beneficiario',
                    value: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                        return record.get( 'fk_id_gestion_beneficiario' );
                    }
                }
            ]
        });
        me.callParent(arguments);
    }
});