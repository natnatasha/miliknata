/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package huehue;
import java.awt.Desktop;
import java.sql.Connection;
import javax.swing.table.DefaultTableModel;
import java.sql.ResultSet;
import java.sql.Statement;
import java.awt.event.ActionEvent;
import java.awt.event.KeyEvent;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.sql.SQLException;
import java.text.SimpleDateFormat;
import java.util.HashMap;
import java.util.Locale;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;
import net.sf.jasperreports.engine.JRException;
import net.sf.jasperreports.engine.JasperCompileManager;
import net.sf.jasperreports.engine.JasperExportManager;
import net.sf.jasperreports.engine.JasperFillManager;
import net.sf.jasperreports.engine.JasperPrint;
import net.sf.jasperreports.view.JasperViewer;
/**
 *
 * @author NATASHA
 */
public class penjualan extends javax.swing.JFrame {
    public Statement st;
    public ResultSet rs;
    public ResultSet rs2;
    public ResultSet rs3;
    public ResultSet rs4;
    public ResultSet rs5;
    public ResultSet rs6;
    public ResultSet rs7;
    public ResultSet rs8;
    public DefaultTableModel tabmodel;
    public DefaultTableModel tbldata;
    public Integer Harga_barang;
    public String kode_barang;
    public Integer stok_barang;
    public long total;
    public long bayar;
    public long kembali;
    
    java.util.Date tglsekarang = new java.util.Date();
    private SimpleDateFormat smpdtfmt = new SimpleDateFormat("dd/MM/yyyy", Locale.getDefault());
    private String tanggal = smpdtfmt.format(tglsekarang);
    Connection cn = koneksi.koneksi.getkoneksi();
    /**
     * Creates new form penjualan
     */
    public penjualan() {
        initComponents();
        item_barang();
        judul();
        tampildata();
        reset();
        autokodetransaksi();
        autokodepenjualan();
        lhapus.setVisible(false);
        lselesai.setVisible(false);
        lbeli.setVisible(false);
        ltanggal.setText(tanggal);
    }
    
    public void laporan(){
        String reportSource = null;
        String reportDest = null;
        
       try{
        reportSource = "F:\\WIKRAMA\\XI\\java\\tokonataa\\src\\huehue\\report2.jrxml";
        reportDest = "F:\\WIKRAMA\\XI\\java\\tokonataa\\src\\huehue\\report2.jasper";
        HashMap parameter = new HashMap();
        parameter.put("huaaa", tkdpenjualan.getText());
        net.sf.jasperreports.engine.JasperReport jasperReport = JasperCompileManager.compileReport(reportSource);
        JasperPrint jasperPrint = JasperFillManager.fillReport(jasperReport,parameter,cn);
        JasperExportManager.exportReportToHtmlFile(jasperPrint, reportDest);
        JasperViewer.viewReport(jasperPrint,false);
       }catch(JRException e){
           e.printStackTrace();
       }
    }
    
    private void autokodepenjualan(){
        try{
            String sql;
            sql = "SELECT COUNT(kode_penjualan) as jumlah FROM penjualan";
            st = cn.createStatement();
            rs5 = st.executeQuery(sql);
            if (rs5.next()) {
                String jumlah = rs5.getString("jumlah");
                int jumint = Integer.parseInt(String.valueOf(jumlah));
                if (jumint > 0) {
                    st = cn.createStatement();
                        sql = "SELECT MAX(kode_penjualan) AS kode FROM penjualan";
                        rs6 = st.executeQuery(sql);
                        if(rs6.next()){
                            String id = rs6.getString("kode").substring(2);
                            String kode = String.valueOf(Integer.parseInt(id) + 1);
                            if(kode.length() == 1){
                               tkdpenjualan.setText("KJ00"+kode);
                            }else if(kode.length() == 2){
                                tkdpenjualan.setText("KJ0"+kode);
                            }else
                                tkdpenjualan.setText("KJ"+kode);
                        }
                }else{
                    tkdpenjualan.setText("KJ001");
                }
            }
        }catch(SQLException e){
        
        }
    }
    
    private void autokodetransaksi(){
        try{
            String sql;
            sql = "SELECT COUNT(kode_transaksi) as jumlah FROM penjualan";
            st = cn.createStatement();
            rs3 = st.executeQuery(sql);
            if (rs3.next()) {
                String jumlah = rs3.getString("jumlah");
                int jumint = Integer.parseInt(String.valueOf(jumlah));
                if (jumint > 0) {
                    st = cn.createStatement();
                        sql = "SELECT MAX(kode_transaksi) AS kode FROM penjualan";
                        rs4 = st.executeQuery(sql);
                        if(rs4.next()){
                            
                            String id = rs4.getString("kode").substring(2);
                            String kode = String.valueOf(Integer.parseInt(id) + 1);
                            if(kode.length() == 1){
                               tkdtransaksi.setText("KT00"+kode);
                            }else if(kode.length() == 2){
                                tkdtransaksi.setText("KT0"+kode);
                            }else
                                tkdtransaksi.setText("KT"+kode);
                        }
                }else{
                    tkdtransaksi.setText("KT001");
                }
            }
        }catch(SQLException e){
        
        }
    }
    
    public void judul() {
        Object[] judul = {"kode transaksi", "barang", "jumlah", "total"};
        tabmodel = new DefaultTableModel(null, judul);
        tabelbeli.setModel(tabmodel);
    }
    
    public void tampildata(){
        try {
            st = cn.createStatement();
            tabmodel.getDataVector().removeAllElements();
            tabmodel.fireTableDataChanged();
            rs = st.executeQuery("select * from penjualan where  kode_penjualan = '"+ tkdpenjualan.getText() +"'");
            while(rs.next()){
                Object[] data = {
                    rs.getString("kode_transaksi"),
                    rs.getString("nama_barang"),
                    rs.getString("jumlah"),
                    rs.getString("harga"),};
                tabmodel.addRow(data);
            }
        } catch (Exception e){
            e.printStackTrace();
        }
    }
    
    public void reset(){
        tjumlah.setText("");
        tharga.setText("");
        cbarang.setSelectedItem("--------------");
    }
    
    
    public void item_barang(){
        try{
            st = cn.createStatement();
            rs = st.executeQuery("SELECT * FROM barang");
            while(rs.next()){
                cbarang.addItem(rs.getString("nama_barang"));
            }
        }catch(Exception e){
            e.printStackTrace();
        }
    }
    
    public void getharga(String name){
        try{
            st = cn.createStatement();
            rs2 = st.executeQuery("SELECT * FROM barang WHERE nama_barang = '"+ name +"'");
            if (rs2.next()) {
                Harga_barang = Integer.parseInt(String.valueOf(rs2.getString("harga")));
                System.out.println(Harga_barang);
            }
        }catch(Exception e){
            e.printStackTrace();
        }
    }
    
    public Integer setharga(){
        return Harga_barang;
    }
    
    public void setstok(){
        try{
            st = cn.createStatement();
            rs8 = st.executeQuery("SELECT * FROM barang WHERE nama_barang = '"+ cbarang.getSelectedItem() +"'");
            if (rs8.next()) {
                String stok = rs8.getString("jumlah");
                stok_barang = Integer.parseInt(String.valueOf(stok));
            }
        }catch(Exception e){
            e.printStackTrace();
        }
    }
    
    public Integer getstok(){
        return stok_barang;
    }
    
    public void FilterHuruf(KeyEvent a){
        if(Character.isDigit(a.getKeyChar())){
            a.consume();
            JOptionPane.showMessageDialog(null, "Masukkan huruf saja!", "Peringatan", JOptionPane.WARNING_MESSAGE);
        }
    }
    
    public void FilterAngka(KeyEvent b){
        if(Character.isAlphabetic(b.getKeyChar())){
            b.consume();
            JOptionPane.showMessageDialog(null, "Masukkan angka saja!", "Peringatan", JOptionPane.WARNING_MESSAGE);
        }
    }
    
    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        bmember = new javax.swing.ButtonGroup();
        jPanel1 = new javax.swing.JPanel();
        jLabel1 = new javax.swing.JLabel();
        ltanggal = new javax.swing.JLabel();
        jPanel3 = new javax.swing.JPanel();
        jLabel4 = new javax.swing.JLabel();
        tkdpenjualan = new javax.swing.JTextField();
        jLabel7 = new javax.swing.JLabel();
        cbarang = new javax.swing.JComboBox<>();
        jLabel6 = new javax.swing.JLabel();
        tjumlah = new javax.swing.JTextField();
        jLabel10 = new javax.swing.JLabel();
        tharga = new javax.swing.JTextField();
        jScrollPane1 = new javax.swing.JScrollPane();
        tabelbeli = new javax.swing.JTable();
        jPanel12 = new javax.swing.JPanel();
        lkembali1 = new javax.swing.JLabel();
        jLabel5 = new javax.swing.JLabel();
        tnama = new javax.swing.JTextField();
        jLabel8 = new javax.swing.JLabel();
        ttotal = new javax.swing.JTextField();
        jLabel9 = new javax.swing.JLabel();
        tbayar = new javax.swing.JTextField();
        jLabel11 = new javax.swing.JLabel();
        tkembalian = new javax.swing.JTextField();
        jLabel12 = new javax.swing.JLabel();
        tkdtransaksi = new javax.swing.JTextField();
        lkdtransaksi = new javax.swing.JLabel();
        lhapus = new javax.swing.JButton();
        lhitung = new javax.swing.JButton();
        lbeli = new javax.swing.JButton();
        lselesai = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        jPanel1.setBackground(new java.awt.Color(204, 204, 204));

        jLabel1.setFont(new java.awt.Font("Tahoma", 0, 16)); // NOI18N
        jLabel1.setForeground(new java.awt.Color(0, 102, 102));
        jLabel1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/gambar/Buying_50px.png"))); // NOI18N
        jLabel1.setText("ELSTORE");

        ltanggal.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        ltanggal.setForeground(new java.awt.Color(0, 102, 102));
        ltanggal.setText("jLabel6");

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jLabel1)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addComponent(ltanggal)
                .addGap(53, 53, 53))
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(ltanggal)
                    .addComponent(jLabel1))
                .addContainerGap(13, Short.MAX_VALUE))
        );

        jPanel3.setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());

        jLabel4.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        jLabel4.setForeground(new java.awt.Color(0, 102, 102));
        jLabel4.setText("Kode Penjualan");

        tkdpenjualan.setEditable(false);
        tkdpenjualan.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        tkdpenjualan.setForeground(new java.awt.Color(0, 102, 102));

        jLabel7.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        jLabel7.setForeground(new java.awt.Color(0, 102, 102));
        jLabel7.setText("Nama Barang");

        cbarang.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        cbarang.setForeground(new java.awt.Color(0, 102, 102));
        cbarang.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "--------------" }));
        cbarang.addItemListener(new java.awt.event.ItemListener() {
            public void itemStateChanged(java.awt.event.ItemEvent evt) {
                cbarangItemStateChanged(evt);
            }
        });

        jLabel6.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        jLabel6.setForeground(new java.awt.Color(0, 102, 102));
        jLabel6.setText("Jumlah");

        tjumlah.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        tjumlah.setForeground(new java.awt.Color(0, 102, 102));
        tjumlah.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyTyped(java.awt.event.KeyEvent evt) {
                tjumlahKeyTyped(evt);
            }
        });

        jLabel10.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        jLabel10.setForeground(new java.awt.Color(0, 102, 102));
        jLabel10.setText("Harga");

        tharga.setEditable(false);
        tharga.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        tharga.setForeground(new java.awt.Color(0, 102, 102));

        tabelbeli.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null}
            },
            new String [] {
                "kode jual", "barang", "jumlah", "total"
            }
        ));
        tabelbeli.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                tabelbeliMouseClicked(evt);
            }
        });
        jScrollPane1.setViewportView(tabelbeli);

        jPanel12.setBackground(new java.awt.Color(0, 102, 102));
        jPanel12.setPreferredSize(new java.awt.Dimension(94, 30));

        lkembali1.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        lkembali1.setForeground(new java.awt.Color(255, 255, 255));
        lkembali1.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        lkembali1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/gambar/icons8_Back_Arrow_20px.png"))); // NOI18N
        lkembali1.setText("Kembali");
        lkembali1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                lkembali1MouseClicked(evt);
            }
        });

        javax.swing.GroupLayout jPanel12Layout = new javax.swing.GroupLayout(jPanel12);
        jPanel12.setLayout(jPanel12Layout);
        jPanel12Layout.setHorizontalGroup(
            jPanel12Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel12Layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(lkembali1)
                .addContainerGap(20, Short.MAX_VALUE))
        );
        jPanel12Layout.setVerticalGroup(
            jPanel12Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(lkembali1, javax.swing.GroupLayout.Alignment.TRAILING, javax.swing.GroupLayout.DEFAULT_SIZE, 30, Short.MAX_VALUE)
        );

        jLabel5.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        jLabel5.setForeground(new java.awt.Color(0, 102, 102));
        jLabel5.setText("Nama");

        tnama.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        tnama.setForeground(new java.awt.Color(0, 102, 102));
        tnama.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyTyped(java.awt.event.KeyEvent evt) {
                tnamaKeyTyped(evt);
            }
        });

        jLabel8.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        jLabel8.setForeground(new java.awt.Color(0, 102, 102));
        jLabel8.setText("Total");

        ttotal.setEditable(false);
        ttotal.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        ttotal.setForeground(new java.awt.Color(0, 102, 102));

        jLabel9.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        jLabel9.setForeground(new java.awt.Color(0, 102, 102));
        jLabel9.setText("Bayar");

        tbayar.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        tbayar.setForeground(new java.awt.Color(0, 102, 102));
        tbayar.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyReleased(java.awt.event.KeyEvent evt) {
                tbayarKeyReleased(evt);
            }
            public void keyTyped(java.awt.event.KeyEvent evt) {
                tbayarKeyTyped(evt);
            }
        });

        jLabel11.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        jLabel11.setForeground(new java.awt.Color(0, 102, 102));
        jLabel11.setText("Kembalian");

        tkembalian.setEditable(false);
        tkembalian.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        tkembalian.setForeground(new java.awt.Color(0, 102, 102));

        jLabel12.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        jLabel12.setForeground(new java.awt.Color(0, 102, 102));
        jLabel12.setText("Kode Transaksi");

        tkdtransaksi.setEditable(false);
        tkdtransaksi.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        tkdtransaksi.setForeground(new java.awt.Color(0, 102, 102));

        lkdtransaksi.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        lkdtransaksi.setForeground(new java.awt.Color(0, 102, 102));

        lhapus.setBackground(new java.awt.Color(0, 102, 102));
        lhapus.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        lhapus.setForeground(new java.awt.Color(255, 255, 255));
        lhapus.setIcon(new javax.swing.ImageIcon(getClass().getResource("/gambar/icons8_Trash_20px.png"))); // NOI18N
        lhapus.setText("Hapus");
        lhapus.setBorderPainted(false);
        lhapus.setContentAreaFilled(false);
        lhapus.setFocusPainted(false);
        lhapus.setFocusable(false);
        lhapus.setOpaque(true);
        lhapus.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                lhapusMouseClicked(evt);
            }
        });

        lhitung.setBackground(new java.awt.Color(0, 102, 102));
        lhitung.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        lhitung.setForeground(new java.awt.Color(255, 255, 255));
        lhitung.setIcon(new javax.swing.ImageIcon(getClass().getResource("/gambar/icons8_Calculator_20px_2.png"))); // NOI18N
        lhitung.setText("Hitung");
        lhitung.setBorderPainted(false);
        lhitung.setContentAreaFilled(false);
        lhitung.setFocusPainted(false);
        lhitung.setFocusable(false);
        lhitung.setOpaque(true);
        lhitung.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                lhitungMouseClicked(evt);
            }
        });

        lbeli.setBackground(new java.awt.Color(0, 102, 102));
        lbeli.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        lbeli.setForeground(new java.awt.Color(255, 255, 255));
        lbeli.setIcon(new javax.swing.ImageIcon(getClass().getResource("/gambar/icons8_Add_20px.png"))); // NOI18N
        lbeli.setText("Beli");
        lbeli.setBorderPainted(false);
        lbeli.setContentAreaFilled(false);
        lbeli.setFocusPainted(false);
        lbeli.setFocusable(false);
        lbeli.setOpaque(true);
        lbeli.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                lbeliMouseClicked(evt);
            }
        });

        lselesai.setBackground(new java.awt.Color(0, 102, 102));
        lselesai.setFont(new java.awt.Font("Tahoma", 0, 13)); // NOI18N
        lselesai.setForeground(new java.awt.Color(255, 255, 255));
        lselesai.setIcon(new javax.swing.ImageIcon(getClass().getResource("/gambar/icons8_Checked_20px.png"))); // NOI18N
        lselesai.setText("Selesai");
        lselesai.setBorderPainted(false);
        lselesai.setContentAreaFilled(false);
        lselesai.setFocusPainted(false);
        lselesai.setFocusable(false);
        lselesai.setOpaque(true);
        lselesai.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                lselesaiMouseClicked(evt);
            }
        });
        lselesai.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                lselesaiActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
            .addGroup(layout.createSequentialGroup()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jPanel12, javax.swing.GroupLayout.PREFERRED_SIZE, 99, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(150, 150, 150)
                        .addComponent(jPanel3, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(22, 22, 22)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(jLabel4)
                                .addGap(46, 46, 46)
                                .addComponent(jLabel12))
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(tkdpenjualan, javax.swing.GroupLayout.PREFERRED_SIZE, 105, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(29, 29, 29)
                                .addComponent(tkdtransaksi, javax.swing.GroupLayout.PREFERRED_SIZE, 105, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addComponent(jLabel7)
                            .addGroup(layout.createSequentialGroup()
                                .addGap(2, 2, 2)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                                    .addComponent(cbarang, 0, 237, Short.MAX_VALUE)
                                    .addComponent(jLabel6)
                                    .addComponent(tjumlah, javax.swing.GroupLayout.DEFAULT_SIZE, 237, Short.MAX_VALUE)
                                    .addComponent(lhitung, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))))
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 330, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(lkdtransaksi, javax.swing.GroupLayout.PREFERRED_SIZE, 50, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                                .addComponent(lhapus))))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(24, 24, 24)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(layout.createSequentialGroup()
                                .addGap(255, 255, 255)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel5)
                                    .addComponent(tnama, javax.swing.GroupLayout.PREFERRED_SIZE, 141, javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGap(48, 48, 48)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel9)
                                    .addComponent(tbayar, javax.swing.GroupLayout.PREFERRED_SIZE, 141, javax.swing.GroupLayout.PREFERRED_SIZE)))
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(jLabel10)
                                .addGap(221, 221, 221)
                                .addComponent(jLabel8)
                                .addGap(160, 160, 160)
                                .addComponent(jLabel11))))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(24, 24, 24)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addComponent(tharga, javax.swing.GroupLayout.PREFERRED_SIZE, 237, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(lbeli))
                        .addGap(18, 18, 18)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(ttotal, javax.swing.GroupLayout.PREFERRED_SIZE, 141, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(48, 48, 48)
                                .addComponent(tkembalian, javax.swing.GroupLayout.PREFERRED_SIZE, 141, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addComponent(lselesai))))
                .addContainerGap(28, Short.MAX_VALUE))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jPanel1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(30, 30, 30)
                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 103, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addComponent(lhapus, javax.swing.GroupLayout.PREFERRED_SIZE, 33, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(0, 0, Short.MAX_VALUE))
                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel4)
                                    .addComponent(jLabel12))
                                .addGap(6, 6, 6)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(tkdpenjualan, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                                    .addComponent(tkdtransaksi, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addGap(11, 11, 11)
                                .addComponent(jLabel7)
                                .addGap(6, 6, 6)
                                .addComponent(cbarang, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(11, 11, 11)
                                .addComponent(jLabel6)
                                .addGap(6, 6, 6)
                                .addComponent(tjumlah, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                                .addComponent(lkdtransaksi, javax.swing.GroupLayout.PREFERRED_SIZE, 16, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(14, 14, 14)))))
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(4, 4, 4)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(jLabel5)
                                .addGap(6, 6, 6)
                                .addComponent(tnama, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(jLabel9)
                                .addGap(6, 6, 6)
                                .addComponent(tbayar, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)))
                        .addGap(11, 11, 11))
                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(lhitung, javax.swing.GroupLayout.PREFERRED_SIZE, 33, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(18, 18, 18)))
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jLabel10)
                    .addComponent(jLabel8)
                    .addComponent(jLabel11))
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(8, 8, 8)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(tharga, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(ttotal, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(tkembalian, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(10, 10, 10)
                        .addComponent(lbeli, javax.swing.GroupLayout.PREFERRED_SIZE, 33, javax.swing.GroupLayout.PREFERRED_SIZE))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(40, 40, 40)
                        .addComponent(lselesai, javax.swing.GroupLayout.PREFERRED_SIZE, 33, javax.swing.GroupLayout.PREFERRED_SIZE)))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jPanel3, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(29, 29, 29)
                .addComponent(jPanel12, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void cbarangItemStateChanged(java.awt.event.ItemEvent evt) {//GEN-FIRST:event_cbarangItemStateChanged
        // TODO add your handling code here:
         String nama_barang = (String) cbarang.getSelectedItem();
         getharga(nama_barang);
         setstok();
    }//GEN-LAST:event_cbarangItemStateChanged

    private void tjumlahKeyTyped(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_tjumlahKeyTyped
        // TODO add your handling code here:
        FilterAngka(evt);
    }//GEN-LAST:event_tjumlahKeyTyped

    private void lkembali1MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_lkembali1MouseClicked
        // TODO add your handling code here:
        dashboard d = new dashboard();
        d.setVisible(true);
        this.setVisible(false);
    }//GEN-LAST:event_lkembali1MouseClicked

    private void tabelbeliMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_tabelbeliMouseClicked
        // TODO add your handling code here:
        lkdtransaksi.setText(tabmodel.getValueAt(tabelbeli.getSelectedRow(), 0) + "");
        lhapus.setVisible(true);
    }//GEN-LAST:event_tabelbeliMouseClicked

    private void tbayarKeyReleased(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_tbayarKeyReleased
        // TODO add your handling code here:
            bayar = Integer.parseInt(String.valueOf(tbayar.getText()));
            total = Integer.parseInt(String.valueOf(ttotal.getText()));
            kembali = bayar - total;
            
            tkembalian.setText(Long.toString(kembali));
    }//GEN-LAST:event_tbayarKeyReleased

    private void tnamaKeyTyped(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_tnamaKeyTyped
        // TODO add your handling code here:
        FilterHuruf(evt);
    }//GEN-LAST:event_tnamaKeyTyped

    private void tbayarKeyTyped(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_tbayarKeyTyped
        FilterAngka(evt);
    }//GEN-LAST:event_tbayarKeyTyped

    private void lbeliMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_lbeliMouseClicked
      if (cbarang.getSelectedItem().equals("") || tjumlah.getText().equals("") || tharga.getText().equals("")){
            JOptionPane.showMessageDialog(null, "Silahkan lengkapi data!");
        } else {
            try{
                st = cn.createStatement();
                st.executeUpdate("insert into penjualan set " + "kode_penjualan='" + tkdpenjualan.getText() + "', kode_transaksi='" + tkdtransaksi.getText() + "', nama_barang='" + cbarang.getSelectedItem()
                    + "', jumlah='" + tjumlah.getText() + "', harga='" + tharga.getText()+ "'");
                autokodetransaksi();
                lbeli.setVisible(false);
                lselesai.setVisible(true);
                tampildata();
                reset();
                JOptionPane.showMessageDialog(null, "Ditambahkan ke antrian!");
                try{
                    st = cn.createStatement();
                    rs = st.executeQuery("SELECT SUM(harga) FROM penjualan WHERE kode_penjualan = '"+ tkdpenjualan.getText() +"'");
                    if (rs.next()) {
                        lselesai.setVisible(true);
                        ttotal.setText(rs.getString(1));
                    }
                }catch(Exception e){
                    e.printStackTrace();
                }
            } catch(Exception e) {
                e.printStackTrace();
            }
        }
    }//GEN-LAST:event_lbeliMouseClicked

    private void lselesaiMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_lselesaiMouseClicked
        if(Integer.parseInt(tbayar.getText()) < Integer.parseInt(ttotal.getText())){
            JOptionPane.showMessageDialog(null, "Uang Kurang");
        }
        else if (!tnama.getText().equals("") && !tkembalian.equals("")) {
            int jawaban;
                if ((jawaban = JOptionPane.showConfirmDialog(null,"Yakin selesai?", "Konfirmasi", JOptionPane.YES_NO_OPTION)) == 0) {
                    try{
                        st = cn.createStatement();
                        st.executeUpdate("INSERT INTO penjualan2 VALUES('"+ tkdpenjualan.getText() +"','"+ tnama.getText() +"','"+ ttotal.getText() +"','"+ tbayar.getText() +"','"+ tkembalian.getText() +"', '"+ ltanggal.getText() +"')");
                        laporan();
                        JOptionPane.showMessageDialog(null,"Transaksi Selesai");
                        autokodetransaksi();
                        autokodepenjualan();
                        tampildata();
                        tabmodel.getDataVector().removeAllElements();
                        tnama.setText("");
                        tjumlah.setText("");
                        tkembalian.setText("");
                        ttotal.setText("");
                        tbayar.setText("");
                        lselesai.setVisible(false);
                        lbeli.setVisible(false);
                    }catch(Exception e){
                        e.printStackTrace();
                    }
                }
        }else{
            JOptionPane.showMessageDialog(null,"Lengkapi Transaksi");
        }
    }//GEN-LAST:event_lselesaiMouseClicked

    private void lhitungMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_lhitungMouseClicked
        // TODO add your handling code here:
        if (!tjumlah.getText().equals("")) {
            int jumlah = Integer.parseInt(String.valueOf(tjumlah.getText()));
            if (getstok().equals("0")) {
                JOptionPane.showMessageDialog(null,"Stok habis!");
            }
            else{
                if (jumlah > getstok()) {
                    tjumlah.setText("");
                    JOptionPane.showMessageDialog(null, "Stok tersisa " + getstok() + ", segera tambahkan!");
                    ttotal.setText("");
                }else{
                    int total = jumlah * setharga();
                    tharga.setText(String.valueOf(total));
                    lbeli.setVisible(true);
                }
            }
        }else{
            JOptionPane.showMessageDialog(null,"Masukan jumlah!");
        }
    }//GEN-LAST:event_lhitungMouseClicked

    private void lhapusMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_lhapusMouseClicked
        // TODO add your handling code here:
        int jawaban;
        if ((jawaban = JOptionPane.showConfirmDialog(null,"Yakin batal?", "Konfirmasi", JOptionPane.YES_NO_OPTION)) == 0) {
        try{
        st = cn.createStatement();
        st.executeUpdate("delete from penjualan where kode_transaksi = '"+lkdtransaksi.getText()+ "'");
        autokodetransaksi();
        tampildata();
        }catch(Exception e){
            e.printStackTrace();
        }
        }
    }//GEN-LAST:event_lhapusMouseClicked

    private void lselesaiActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_lselesaiActionPerformed
        // TODO add your handling code here:
        
    }//GEN-LAST:event_lselesaiActionPerformed

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(penjualan.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(penjualan.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(penjualan.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(penjualan.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new penjualan().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.ButtonGroup bmember;
    private javax.swing.JComboBox<String> cbarang;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel10;
    private javax.swing.JLabel jLabel11;
    private javax.swing.JLabel jLabel12;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JLabel jLabel5;
    private javax.swing.JLabel jLabel6;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JLabel jLabel9;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JPanel jPanel12;
    private javax.swing.JPanel jPanel3;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JButton lbeli;
    private javax.swing.JButton lhapus;
    private javax.swing.JButton lhitung;
    private javax.swing.JLabel lkdtransaksi;
    private javax.swing.JLabel lkembali1;
    private javax.swing.JButton lselesai;
    private javax.swing.JLabel ltanggal;
    private javax.swing.JTable tabelbeli;
    private javax.swing.JTextField tbayar;
    private javax.swing.JTextField tharga;
    private javax.swing.JTextField tjumlah;
    private javax.swing.JTextField tkdpenjualan;
    private javax.swing.JTextField tkdtransaksi;
    private javax.swing.JTextField tkembalian;
    private javax.swing.JTextField tnama;
    private javax.swing.JTextField ttotal;
    // End of variables declaration//GEN-END:variables
}
