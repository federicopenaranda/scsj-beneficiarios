Ext.define('sisscsj.view.evaluaciones.Biblioteca.edit.tab.Evaluacion', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.evaluaciones.biblioteca.edit.tab.evaluacion',
    layout: 'form',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Consulta Bibliográfica</strong>',
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
                                    name: 'fk_id_area_cononcimiento_biblioteca',
                                    fieldLabel: 'Área de Conocimiento:',
                                    displayField: 'nombre_area_conocimiento_biblioteca',
                                    valueField: 'id_area_conocimiento_biblioteca',
                                    store: {
                                        type: 'opciones.areaconocimientobiblioteca'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'combobox',
                                    name: 'tipo_usuario_biblioteca',
                                    fieldLabel: 'Tipo de Usuario:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreTipoUsuarioBiblioteca,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
,
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_nivel',
                                    fieldLabel: 'Nivel:',
                                    displayField: 'nombre_nivel',
                                    valueField: 'id_nivel',
                                    store: {
                                        type: 'opciones.nivel'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_curso',
                                    fieldLabel: 'Curso:',
                                    displayField: 'nombre_curso',
                                    valueField: 'id_curso',
                                    store: {
                                        type: 'opciones.curso'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_turno',
                                    fieldLabel: 'Turno:',
                                    displayField: 'nombre_turno',
                                    valueField: 'id_turno',
                                    store: {
                                        type: 'opciones.turno'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
{
                                    xtype: 'combobox',
                                    name: 'sexo_usuario_biblioteca',
                                    fieldLabel: 'Sexo:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: LocalStoreSexos,
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_consulta_biblioteca',
                                    fieldLabel: 'Fecha de Consulta',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'observaciones_biblioteca',
                                    fieldLabel: 'Observaciones',
                                    height: 100
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
})