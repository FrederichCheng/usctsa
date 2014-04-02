<?php

/*
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */

/**
 * Description of word_bag_db_model
 *
 * @author Shao-yen(Frederich) Cheng 
 */
class word_bag_db_model implements word_bag_model{
//    
//    private final Connection conn;
//
//    public WordBagDBModel(String username, String password, String url) throws SQLException, ClassNotFoundException {
//        Class.forName("com.mysql.jdbc.Driver");
//        conn = DriverManager.getConnection(url, username, password);
//    }
//    
//    public WordBagDBModel(Connection conn){
//        this.conn = conn;
//    }
//    
//    private int classCount = -1;
//    
//    @Override
//    public int getCategoryCount() throws SQLException {
//        if(classCount < 0){
//            PreparedStatement stmt = conn.prepareStatement("select count(*) as c from facebook_categories");
//            ResultSet result = stmt.executeQuery();
//            if(!result.next()){
//                result.close();
//                stmt.close();
//                return 0;
//            }
//            classCount = result.getInt("c");
//            result.close();
//            stmt.close();
//        }
//        return classCount;
//    }
//
//    @Override
//    public double getCategoryOccurence(Category c) throws SQLException {
//        PreparedStatement stmt = conn.prepareStatement("select count from facebook_categories where name=?");
//        stmt.setString(1, c.getName());
//        ResultSet result = stmt.executeQuery();
//        if(!result.next()){
//            result.close();
//            stmt.close();
//            return 0;
//        }
//        int count = result.getInt("count");
//        result.close();
//        stmt.close();
//        return count;
//    }
//
//    private Category[] categories = null;
//    @Override
//    public Category[] getCategories() throws SQLException {
//        if(categories == null){
//            
//            ArrayList<Category> list = new ArrayList();
//            PreparedStatement stmt = conn.prepareStatement("select name from facebook_categories");
//            ResultSet result = stmt.executeQuery();
//
//            while(result.next()){
//                String name = result.getString("name");
//                list.add(getCategory(name));
//            }
//            
//            result.close();
//            stmt.close();
//            Category[] arr = new Category[list.size()];
//            categories = list.toArray(arr);
//        }
//        return categories;
//    }
//    
//    @Override
//    public Category getCategory(String name) throws SQLException{
//        PreparedStatement stmt;
//            try {
//                stmt = conn.prepareStatement(
//                        "select sum(count) as sum from facebook_words where "
//                                + "category=? "
//                                + "group by category");
//                stmt.setString(1, name);
//                ResultSet result = stmt.executeQuery();
//                if(!result.next()){
//                    result.close();
//                    stmt.close();
//                    return new CategoryImpl(name, 0);
//                }
//                int sum = result.getInt("sum");
//                result.close();
//                stmt.close();
//                return new CategoryImpl(name, sum);
//            } catch (SQLException ex) {
//                throw new RuntimeException(ex.getMessage());
//            }
//    }
//
//    private int totalSample = -1;
//    
//    @Override
//    public int getTotalSampleCount() throws SQLException {
//        if(totalSample < 0){
//            PreparedStatement stmt = conn.prepareStatement("select sum(count) as c from facebook_categories");
//            ResultSet result = stmt.executeQuery();
//            if(!result.next()){
//                result.close();
//                stmt.close();
//                return 0;
//            }
//            totalSample = result.getInt("c");
//            result.close();
//            stmt.close();
//        }
//        return totalSample;
//    }
//
//    private int totalWords = -1;
//    @Override
//    public int getTotalWords() throws SQLException {
//        if(totalWords < 0){
//            PreparedStatement stmt = conn.prepareStatement("select sum(count) as c from facebook_words");
//            ResultSet result = stmt.executeQuery();
//            if(!result.next()){
//                result.close();
//                stmt.close();
//                return 0;
//            }
//            totalWords = result.getInt("c");
//            result.close();
//            stmt.close();
//        }
//        return totalWords;
//    }
//
//    
//    
//    private int vocSize = -1;
//    
//    @Override
//    public int getVocabularySize() throws SQLException {
//        if(vocSize < 0){
//            PreparedStatement stmt = conn.prepareStatement("select count(*) as c from (select word from facebook_words group by `word`) as t1");
//            ResultSet result = stmt.executeQuery();
//            if(!result.next()){
//                result.close();
//                stmt.close();
//                return 0;
//            }
//            vocSize = result.getInt("c");
//            result.close();
//            stmt.close();
//        }
//        return vocSize;
//    }
//    
//    public void closeConnection() throws SQLException{
//        conn.close();
//    }
//    
//}

}
